particlesJS.load('particles-1', amvcPageData.siteUrl+'/src/assets/landing/pjs-config-1.json', () => {
    console.log('callback - particles.js config loaded')
})

particlesJS.load('particles-2', amvcPageData.siteUrl+'/src/assets/landing/pjs-config-2.json', () => {
    console.log('callback - particles.js config loaded')
})

let date = new Date()

document.getElementById('this-date').innerHTML = date.getFullYear();

document.body.onscroll = () => {
    const nav = document.querySelector('.nav-bar')
    if(scrollY > 100) {
        nav.classList.add('active')
    } else {
        nav.classList.remove('active')
    }
}

const navDom = document.querySelector('.nav-bar__center')

const nav = {
    open: ()=>{
        navDom.classList.add('active')
    },
    close: ()=> {
        navDom.classList.remove('active')
    }
}