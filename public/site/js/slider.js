const mySlider = document.querySelector('#slider')
if (mySlider !== 'undefined') {
  const carousel = new bootstrap.Carousel(mySlider, {
    interval: 2000,
    wrap: true,
  })
}
