<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="container">
        <h1>Login</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form id="loginForm">
            @csrf
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div>
                <label for="password">Senha:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>       
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault();
    
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;  
           
            fetch('{{ route('api.login') }}', {  
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    email: email,
                    password: password
                })
            })            
            .then(response => response.json())            
            .then(data => {                
                if (data) {                    
                    localStorage.setItem('jwtToken', data.token);                                      
                    window.location.href = '{{ route('conversion') }}'; 
                } else {
                    console.error('Login failed');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
</body>

</html>
