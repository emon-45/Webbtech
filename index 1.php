<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css">
<img src="webbbbb.png" class="top-right-image" alt="Top Right Image">
<title>Test</title>
</head>
<body>
<main>
    <aside class="box3"></aside>
    <div>
        <section>
            <div class="box1"></div>
            <div class="box1"></div>
            <div class="box1"></div>
        </section>
        <section class="section2">
            <div class="box2"></div>
            <div class="box2"></div>
            <div class="box2"></div>
        </section>
        <section class="section2">
            <div class="box22">
                <form action="process.php" method="post">
                    <label for="stname">Student Name:</label>
                    <input type="text" id="stname" name="stname" placeholder="Student full name">
                    
                    <label for="stid">Student ID:</label>
                    <input type="text" id="stid" name="stid" placeholder="Student ID">
                    
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Student Email">
                    
                    <label for="book-title">Book Title:</label>
                    <select name="bt" id="book-title">
                        <option value="HCI">HCI</option>
                        <option value="ML">ML</option>
                        <option value="NPL">NPL</option>
                        <option value="MATH">MATH</option>
                        <option value="PHYSIC">PHYSIC</option>
                        <option value="GM">GM</option>
                        <option value="HM">HM</option>
                        <option value="WEB TECH">WEB TECH</option>
                        <option value="DM">DM</option>
                        <option value="ENGLISH">ENGLISH</option>
                    </select>

                    <label for="bd">Borrow Date:</label>
                    <input type="date" id="bd" name="bd" placeholder="Borrow Date">

                    <label for="rn">Return Date:</label>
                    <input type="date" id="rn" name="rn" placeholder="Return Date">

                    <label for="tn">Token Number:</label>
                    <input type="text" id="tn" name="tn" placeholder="Token Number">

                    <label for="fees">Fees:</label>
                    <input type="text" id="fees" name="fees" placeholder="Fees">

                    <button type="submit" name="sub">Submit</button>
                </form>
            </div>
            <div class="box22"></div>
        </section>
    </div>
    <aside class="box3"></aside>
</main>
</body>
</html>
