const hamMenu = document.querySelector('.ham-menu');
const offScreenMenu = document.querySelector('.off-screen-menu');

hamMenu.addEventListener('click', () => {
    hamMenu.classList.toggle('active');
    offScreenMenu.classList.toggle('active');
});
const menuItems = document.querySelectorAll('.off-screen-menu a');

menuItems.forEach(item => {
    item.addEventListener('click', event => {
        event.preventDefault(); 
        const targetUrl = item.getAttribute('href'); 
        window.location.href = targetUrl;
    });
});