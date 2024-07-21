import Splide from "@splidejs/splide"

export function lookupSplideSlider(element: Element) {
	const splide: HTMLElement | null = element.querySelector(".splide")

	if (!splide) return

	new Splide(splide).mount()
}
