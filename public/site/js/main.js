const headerElm = document.getElementsByTagName('header')[0]
const headerLogo = headerElm.querySelector('.header-logo')
const headerMenu = headerElm.querySelector('.header-menu')
const headerSearch_cart = headerElm.querySelector('.header-search_cart')

const headerFormElm = headerElm.querySelector('.header-form-search')
const bgOverlay = document.getElementById('bg-overlay')

window.onscroll = function () {
  scrollFunction()
}
const headerHeight = headerElm.offsetHeight
function scrollFunction() {
  if (document.body.scrollTop > headerHeight || document.documentElement.scrollTop > headerHeight) {
    headerElm.classList.add('fixed')
  } else {
    headerElm.classList.remove('fixed')
  }
}

function showSearchForm() {
  headerLogo.classList.add('none')
  headerMenu.classList.add('none')
  headerSearch_cart.classList.add('none')

  headerFormElm.classList.remove('none')
  bgOverlay.classList.remove('none')

  bgOverlay.onclick = () => {
    hiddenSearchForm()
  }
}

function hiddenSearchForm() {
  headerLogo.classList.remove('none')
  headerMenu.classList.remove('none')
  headerSearch_cart.classList.remove('none')

  headerFormElm.classList.add('none')
  bgOverlay.classList.add('none')
}

// Show alert login
window.addEventListener('alertLogin', e => {
  data = e.detail[0]
  Swal.fire({
    title: data.title,
    text: data.mess,
    icon: data.icon,
  })
})

// reload page
window.addEventListener('reloadPage', e => {
  data = e.detail[0]
  if (data.timeDelay) {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: data.timeDelay * 1000 ?? 1000,
      timerProgressBar: true,
      didOpen: toast => {
        toast.onmouseenter = Swal.stopTimer
        toast.onmouseleave = Swal.resumeTimer
      },
    })
    Toast.fire({
      icon: 'success',
      title: data.message ?? 'Đăng nhập thành công!',
    })
  }
  setTimeout(() => {
    location.reload()
  }, data.timeDelay * 1000 ?? 1000)
})

// Auth google
function receiveDataFromGoogleLoginWindow(data) {
  timer = 1500
  if (data.status === 'success') {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: timer,
      timerProgressBar: true,
      didOpen: toast => {
        toast.onmouseenter = Swal.stopTimer
        toast.onmouseleave = Swal.resumeTimer
      },
    })
    Toast.fire({
      icon: 'success',
      title: data.message,
    })
    setTimeout(() => {
      location.reload()
    }, timer)
  } else {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: timer,
      timerProgressBar: true,
      didOpen: toast => {
        toast.onmouseenter = Swal.stopTimer
        toast.onmouseleave = Swal.resumeTimer
      },
    })
    Toast.fire({
      icon: 'error',
      title: data.message,
    })
  }
}

function alertCustom({  message = '', type = 'success', duration = 1500 }) {
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: duration,
    timerProgressBar: true,
    didOpen: toast => {
      toast.onmouseenter = Swal.stopTimer
      toast.onmouseleave = Swal.resumeTimer
    },
  })
  Toast.fire({
    icon: type,
    title: message,
  })
}

function toggleShowPassword(elm){
  const inputElm = elm.parentNode.querySelector('input');
  inputElm.type = inputElm.type=='password' ? 'text' : 'password';
  if(inputElm.type=='password'){
    elm.querySelector('i').classList = "fa-regular fa-eye";
  }else{
    elm.querySelector('i').classList = "fa-regular fa-eye-slash";

  }
}

