import { lookupSplideSlider } from "./slider"

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
		lookupSplideSlider(event.target)
	}
})

lookupSplideSlider(document.querySelector("#main") as Element)
