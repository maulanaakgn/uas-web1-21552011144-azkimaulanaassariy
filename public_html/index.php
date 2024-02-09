<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    function checkSession() {
        const formData = new FormData();
        formData.append('session_token', localStorage.getItem('session_token'));

        axios.post('https://kel7web.000webhostapp.com/config/session.php', formData)
        .then(response => {
            console.log(response);
            if (response.data.status === 'success'){
                const ndepan = response.data.hasil.ndepan || 'Default Name';
                const nbelakang = response.data.hasil.nbelakang || 'Default Name';
                const image = response.data.hasil.image || 'Default Image';
                localStorage.setItem('ndepan', ndepan);
                localStorage.setItem('nbelakang', nbelakang);
                localStorage.setItem('imagePath', image);
                window.location.href = 'dashboard.php';
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
