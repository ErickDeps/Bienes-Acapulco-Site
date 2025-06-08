const msgSuccess = document.getElementById('msg-success');
      

if (msgSuccess) {
    setTimeout(() => {
        msgSuccess.style.display = 'none';
        window.location.href = '?controller=session&action=showlogin';
    }, 3000);
}

