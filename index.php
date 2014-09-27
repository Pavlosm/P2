<!DOCTYPE html>

<head>
    <title>Pavlos Migkiros xkcd style password generator</title>
    <link rel="stylesheet" href="bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="style.css" type="text.css">
    <script src="jquery.js"></script>

    <?php require('logic.php');?>
</head>

<body>
    <div id="header" class="container">
        <h1>Pav's XKCD Password Generator</h1>
    </div>
    <div id="main_container" class="container">

        <h2>This is an xkcd password generator</h2>
        <p>
            This page has a password generator which you can use to create a strong easy-memorable xkcd style password.
        </p>
        <h3>How to use the generator</h3>
        <p>
            Using the password generator is simple. You just have to specify your password requirements by checking the
            checkboxes and a random password is generated for you.
        </p>
        <p>
            You can choose:
            <ul>
                <li>The number of words</li>
                <li>To include a number or not</li>
                <li>To include a special symbol or not ()</li>
                <li>To uppercase the first of the password or not</li>
            </ul>
        </p>
        <div class="generator_container">
            <div class="password"> <?=$password?></div>
            <div class="errors">

            </div>
            <form>
                <input type="submit" name="generate" value="generate password" class="btn btn-default btn-lg"> </br>
                Number of words: <input type="text" name="num_words" size="3px"> &nbsp; &nbsp;
                <input type="checkbox" name="number" value="Bike">&nbsp; Add a number &nbsp; &nbsp;
                <input type="checkbox" name="special_char" value="Car"> &nbsp; Add a special character &nbsp; &nbsp;
                <input type="checkbox" name="number" value="Bike">&nbsp; Capitalize first password letter &nbsp; &nbsp;
                <input type="checkbox" name="special_char" value="Car">I have a car &nbsp;
            </form>
            </br>
            <image id="xkcd_image" src="password_strength.png" alt="password-strength "/>
        </div>
        <h3>What is XKDC and why is it "better"</h3>
        <h4>Password strength</h4>
        <p>
            Braking a password computationally, is all about searching all possible combinations of the components of
            the given set that is used to create the password, to find the correct one. This is easier to explain with
            an example.
        </p>
        <p>
            Suppose that you want to create a password using only 2 characters 'a' and 'b', with a length of 2. In this
            case the set of components is {a, b}. All possible combinations are just two 'ab' and 'ba'. Therefore, the
            worst case scenario to guess that password would be two tries.
        </p>
        <p>
            Increasing the length of the password to 3, will increase the number of possible combinations to 2^4 = 16
            {aaa, aab, aba, baa, bbb, bba, bab, abb }. From this it is obvious that the longer the password the better
            its strength.
        </p>
        <p>
            What would happen if we added another component to the set? Lets say that we add 'c' so we have {a, b, c} to
            choose from, to create a 3-letter password. All available combinations now are 3^3 = 27. So, the bigger the
            pool of components the harder it becomes to break the password.
        </p>
        <p>
            This leads to a general equation for the password strength of the form:
        <ul>
            <li> pass-strength = a^b </li>
            <li> a: the number of components of the set </li>
            <li> b: the length of the password </li>
        </ul>
        Below there are three example sets (from "weaker" to "stronger"):
        <ul>
            <li> Use only lower case alphabetical characters: ( a = 26 )</li>
            <li> Use both lower and upper case alphabetical characters: ( a = 52 )</li>
            <li> Use 12 special characters in addition to the above set: ( a = 64 )</li>
        </ul>
        So, using the same password set, the third set would generate a computationally stronger password to break.
        </p>
        <p>
            How easy is however to remember a seemingly random password obtained by the third set above, say 'iETh$#y'?
            Well this looks hard and it is definitely hard to remember, but is it harder, from a computational
            standpoint, than the simple dumb password 'Pavlos$' (my name)? According to the above it is not; they have
            the same length and use the same character set.
        </p>
        <h4>xkdc approach</h4>
        <p>
            Instead of using the usual approach, which is creating an ugly and difficult to memorize lets say 12-char
            password which will have upper and lower case letters, special chars and numbers, we can create a much
            stronger one which will be user friendly.
        </p>
        <p>
            To do this we can create a password that uses actual words that have a meaning. Now in this case the
            individual components will be the actual words, so if we use a pool of 2048 words to create a 3-word long
            password, it would need 2048^3 tries to break it and additionally it would be easy for us to do so.
        </p>
        <p>
            Finally on top of that we can capitalize letters and add special characters which will boost its strength
            even more.
        </p>
        <p>
            And this is the xkcd style approach.
        </p>
    </div>
</body>


