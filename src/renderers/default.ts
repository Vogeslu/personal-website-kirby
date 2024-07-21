import { Renderer } from "@unseenco/taxi"
import { lazyLoad } from "unlazy"
import htmx from "htmx.org"
import Splide from "@splidejs/splide"

export default class extends Renderer {
	initialLoad() {
		lazyLoad()

		const mainContent = document.querySelector("#main") as HTMLElement
		this.lookupSplideSlider(mainContent)
		this.lookupDarkmodeToggle(document)

		const instance = this

		document.addEventListener("htmx:afterSwap", function (event) {
			if (
				event.target instanceof HTMLElement &&
				event.target.id == "project-preview"
			) {
				document.querySelector("body")!.style.overflowY = "hidden"

				const preview: HTMLElement = event.target

				preview.querySelector(".close")?.addEventListener("click", () => {
					preview.innerHTML = ""
					document.querySelector("body")!.style.overflowY = "auto"
				})
			}

			if (event.target instanceof HTMLElement) {
				instance.lookupSplideSlider(event.target)
			}
		})
	}

	onEnterCompleted() {
		htmx.process(this.content)
		this.lookupSplideSlider(this.content)
		this.lookupDarkmodeToggle(this.content)

		document.querySelector("body")!.style.overflowY = "auto"

		this.remove()
		lazyLoad()
	}

	lookupSplideSlider(element: Element) {
		const splide: HTMLElement | null = element.querySelector(".splide")

		if (!splide) return

		new Splide(splide).mount()
	}

	lookupDarkmodeToggle(element: Element | Document) {
		const toggle = element.querySelector("#darkmode-toggle") as HTMLInputElement

		const htmlElement = document.querySelector("html")!

		let darkmode = htmlElement.classList.contains("dark")

		if (
			!htmlElement.classList.contains("dark") &&
			!htmlElement.classList.contains("light")
		) {
			const prefersDarkColorScheme = () =>
				window &&
				window.matchMedia &&
				window.matchMedia("(prefers-color-scheme: dark)").matches

			darkmode = prefersDarkColorScheme()
		}

		if (darkmode) toggle.setAttribute("checked", "true")
		else toggle.removeAttribute("checked")

		window.setTimeout(() => {
			toggle.parentElement
				?.querySelectorAll(".transition-block")
				.forEach((element) => element.classList.remove("transition-none"))
		})

		toggle.addEventListener("change", function () {
			const htmlElement = document.querySelector("html")!

			htmlElement.classList.toggle("dark", toggle.checked)
			htmlElement.classList.toggle("light", !toggle.checked)

			document.cookie = `darkmode=${toggle.checked ? "true" : "false"}; expires=Thu, 1 Jan 2099 12:00:00 UTC; path=/`
		})
	}
}
