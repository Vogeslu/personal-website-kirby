import "htmx.org"
import { Core } from "@unseenco/taxi"
import { Application, AttributeObserver } from "@hotwired/stimulus"
import type { ControllerConstructor } from "@hotwired/stimulus"
import type { Transition, Renderer } from "@unseenco/taxi"
import "@splidejs/splide/css"

import.meta.glob(["../assets/**"]) // Import all assets for copying them to dist

declare global {
	interface Window {
		Stimulus: Application
		Taxi: Core
	}
}

// Register Stimulus & controllers
window.Stimulus = Application.start()

// Register all eager controllers in the controllers folder
for (const [key, controller] of Object.entries(
	import.meta.glob(["./controllers/*.ts", "!./controllers/*.lazy.ts"], {
		eager: true
	})
)) {
	window.Stimulus.register(
		key.slice(14, -3),
		(controller as { default: ControllerConstructor }).default
	)
}

// Register observer & lazy controllers
const lazyControllers = Object.entries(
	import.meta.glob("./controllers/*.lazy.ts")
).reduce((prev, [key, controller]) => {
	prev.set(
		key.slice(14, -8),
		controller as () => Promise<{ default: ControllerConstructor }>
	)
	return prev
}, new Map<string, () => Promise<{ default: ControllerConstructor }>>())

const loadController = async (element: HTMLElement) => {
	// data-controller attribute can contain multiple controllers
	const controllerNames = element
		.getAttribute(
			window.Stimulus.schema.controllerAttribute ?? "data-controller"
		)
		?.split(/\s+/)

	for (const name of controllerNames ?? []) {
		// If the controller is not registered yet, register it
		if (
			!window.Stimulus.router.modules.some(
				(module) => module.definition.identifier === name
			)
		) {
			const controllerDefinition = (await lazyControllers.get(name)?.())
				?.default
			if (controllerDefinition)
				window.Stimulus.register(name, controllerDefinition)
		}
	}
}

const controllerObserver = new AttributeObserver(
	window.Stimulus.element,
	window.Stimulus.schema.controllerAttribute,
	{
		elementMatchedAttribute: loadController,
		elementAttributeValueChanged: loadController
	}
)

controllerObserver.start()

if (import.meta.env.DEV) {
	window.Stimulus.debug = true
}

// Install Taxi
window.Taxi = new Core({
	renderers: Object.entries(
		import.meta.glob("./renderers/*.ts", { eager: true })
	).reduce(
		(acc, [key, transition]) => {
			acc[key.slice(12, -3)] = (
				transition as { default: typeof Renderer }
			).default
			return acc
		},
		{} as Record<string, typeof Renderer>
	),
	transitions: Object.entries(
		import.meta.glob("./transitions/*.ts", { eager: true })
	).reduce(
		(acc, [key, transition]) => {
			acc[key.slice(14, -3)] = (
				transition as { default: typeof Transition }
			).default
			return acc
		},
		{} as Record<string, typeof Transition>
	),
	allowInterruption: true,
	removeOldContent: false
})
