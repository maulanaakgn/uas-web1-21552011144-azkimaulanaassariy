<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    function checkSession() {
        const formData = new FormData();
        formData.append('session_token', localStorage.getItem('session_token'));

        axios.post('https://kel7web.000webhostapp.com/config/session.php', formData)
        .then(response => {
            console.log(response);
            if (response.data.status === 'success'){
                const name = response.data.hasil.name || 'Default Name';
                localStorage.setItem('nama', name);
            } else {
                window.location.href = 'login.php';
            }
        }) 
        .catch(error => {
            console.error('Error checking session:', error);
        });
    }

    checkSession();
</script>
