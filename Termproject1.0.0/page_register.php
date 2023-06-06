<doctype html>
    <html>

    <head>
        <title>sign up page</title>
    </head>

    <body>
        <form name="join" method="post" action="page_join.php">
            <h1>input your information</h1>
            <table border="1">
                <tr>
                    <td>E-MAIL</td>
                    <td><input type="text" size="30" name="email"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" size="30" name="pwd"></td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td><input type="password" size="30" name="pwd2"></td>
                </tr>
                <tr>
                    <td>name</td>
                    <td><input type="text" size="12" maxlength="10" name="name"></td>
                </tr>
                <tr>
                    <td>birth day</td>
                    <td>
                        <input type="date" id="start" name="birthday" value="2022-06-22" min="1900-01-01"
                            max="2022-06-22">
                    <td>
                </tr>
                <tr>
                    <td>sex</td>
                    <td><input type="text" size="1" maxlength="2" name="sex"></td>
                </tr>
            </table>
            <input type=submit value="submit"><input type=reset value="rewrite">
        </form>
    </body>

    </html>