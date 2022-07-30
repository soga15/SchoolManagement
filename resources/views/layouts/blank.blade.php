    <body >
         <div>
          @yield('content')
          <form action="">
            <div>
                <label for="">Username : </label>
                <input type="type" placeholder="usename">
            </div> 
            <br>
            <div>
                <label for="">Password: </label>
                <input type="type" placeholder="password">
            </div>
            <br>
            <div>
                <button type="submit">Login</button>
                <button type="submit"><a href="/register">Register</a></button>
                <label>
                  <input type="checkbox" checked="checked" name="remember"> Remember me
                </label>
            </div>
        </form>
        </div>
    </body>

