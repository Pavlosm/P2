<!DOCTYPE html>

<head>
    <title>Pavlos Migkiros xkcd style password generator</title>
    <link rel="stylesheet" href="bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="style.css" type="text.css">
    <script src="jquery.js"></script>
    <style type="text/css">

        .container {
            background-color: #F2F8FF;
            max-width: 900px;
        }

        .header {
            color: #e5eaff;
            min-height: 100px;
            background-color: #14263d;
            font-weight: bold;
            max-width: 900px;
            border-bottom: solid #071123 thick;
        }

        img {
            max-width: 60%;
            height: auto;
            width: auto\9;
            cursor: hover;
        }

        .generator_container {
            background-color: #e1e5ec;
            text-align: center;
            padding-top: 10px;
            padding-bottom: 40px;
            border-radius: 30px;
            -webkit-box-shadow: inset 10px 10px 88px 0px rgba(0,0,0,0.46);
            -moz-box-shadow: inset 10px 10px 88px 0px rgba(0,0,0,0.46);
            box-shadow: inset 10px 10px 88px 0px rgba(0,0,0,0.46);
        }

        .password {
            max-width: 80%;
            background-color: #4d506f;
            font-size: 30px;
            margin: 10px auto 10px auto;
            min-width: 60px;
            border: inset 15px #cee2ff;
            color: #cee2ff;
        }

        .btn {
            background-color: #414f6b;
            border: outset #c0ba56 thick;
            color: white;
        }

    </style>
    <?php require('logic.php');?>

</head>

<body>
    <div class="container header">
        <h1>Pav's XKCD Password Generator</h1>
    </div>
    <div class="container main-container">

        <h2>This is an xkcd password generator</h2>
        <p>
            This page has a password generator which you can use to create a strong easy-memorable xkcd style password.
            XKDC style password is based on a comic which suggests using words or phrases to create our passwords rather
            than using a single-word ugly password like "pASS%worD7", which is quite hard to memorize.
        </p>
        <h3>How to use the generator</h3>
        <p>
            Using the password generator is simple. You just have to specify your password requirements by typing the
            desired number of words (length of password) and choosing some additional parameters by checking the
            checkboxes.
        </p>
        <p>
            Specifically you can choose:
            <ul>
                <li>the number of words (1-6 words)</li>
                <li>to include a number between 1-9 at the end</li>
                <li>to include a special symbol at a random position, from the symbols ( !@#$%^&*()_+ )</li>
                <li>to uppercase the first letter of the password</li>
            </ul>
        </p>
        <div class="generator_container">
            <h2> New Password:</h2>
            <div class="password"> <?=$password?> </div>

            <form action="index.php" method="POST">
                <input type="submit" value="Generate Password" class="btn btn-default btn-lg"> <br /><br />

                <label for="num_words">number of words</label>
                <input type="text" name="num_words" value="4" size="3px"> <br />

                <label for="number">add a number</label>
                <input type="checkbox" name="number" value="yes"> <br />

                <label for="special_char">add a special char</label>
                <input type="checkbox" name="special_char" value="yes">  <br />

                <label for="capital_letters">capitalize first letter</label>
                <input type="checkbox" name="capital_letter" value="yes">  <br />

            </form>
            <br />
            <a href="http://xkcd.com/936/" target="_blank">
                <image class="xkcd_image" src="password_strength.png" alt="password-strength "/>
            </a>
        </div>
        <h3>What is XKDC and why is it "better" (at least my understanding of it...)</h3>
        <h4>Password strength</h4>
        <p>
            Braking a password computationally, is all about searching all possible combinations of the components of
            the given set that is used to create the password, to find the correct one. This is easier to explain with
            an example.
        </p>
        <p>
            Suppose that you want to create a password using only 2 characters 'a' and 'b', with a length of 2. In this
            case the set of components is {a, b}. All possible combinations are just two 'ab' and 'ba'. Therefore, the
            worst case scenario to guess that password would be -> two tries.
        </p>
        <p>
            Increasing the length of the password to 3, will increase the number of possible combinations to 2^3 = 8
            {aaa, aab, aba, baa, bbb, bba, bab, abb }. From this it is obvious that the longer the password the better
            its strength.
        </p>
        <p>
            What would happen if we added another component to the set? Lets say that we add 'c' so we have {a, b, c} to
            choose from, to create a 3-letter password. All available combinations now are 3^3 = 27. So, the bigger the
            pool of components the harder it becomes to break the password.
        </p>
        <p>
            This leads to a general equation for the password strength (entropy) of the form:
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
            Well this looks strong and it is definitely hard to remember, but is it harder from a computational
            standpoint than the simple dumb password 'Pavlos$' (my name)? According to the above it is not; they have
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
            password, it would need 2048^3 tries to break it and additionally it would be easy for us to remember it.
        </p>
        <p>
            On top of that we can capitalize letters and add special characters which will boost its strength even more.
        </p>
        <p>
            And this is the xkcd style approach.
        </p>
    </div>
</body>


