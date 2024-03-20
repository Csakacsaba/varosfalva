var message = document.getElementById('my-success')
console.log(message)
if (message) {
    setTimeout(function () {
        message.style.display = 'none';
    }, 3000)
}
document.addEventListener('LikesToTable', function () {
})
