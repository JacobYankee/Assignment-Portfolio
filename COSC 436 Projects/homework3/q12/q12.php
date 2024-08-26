<!--Jacob Yankee
COSC 436
Maniccam
Homework 3-->
<!DOCTYPE html>
<html lang = "en">
    <head>
        

		<meta name="author" content = "Jacob Yankee">
		<meta name="keywords" content="resume computer science eastern michigan university">
		<style>
		/*name and contact information centered*/
		    h1 {
			    text-align:center;
				}
			h3 {
				text-align:center;
				}
				a:link {color:slateblue;}
				a:visited {color:slategray;}
				a:hover {color:deepskyblue;}
				a:active {color:steelblue;}
			hr {
				height:2px;
				border-width:0;
				color:darkslategray;
				background-color:darkslategray;
				}
			body {
				background-color:antiquewhite;
				}
			/*odd and even class tags to alter background colors, fonts, font sizes, and alignments*/
			.odd {
				font-family:Georgia, serif;
				}
			.even {
				font-size:110%;
				font-family:Garamond, serif;
				background-color:floralwhite;
				text-align:center;
				}
				
		</style>
    </head>

    <body>
        <?php
		//obtain password from form, check if password matches 
		//if match, print resume
        $pw = $_POST["password"];
        if ($pw == "password1" || $pw == "password2" || $pw == "password3" || $pw == "password4" || $pw == "password5")
        {
			echo "<title>Jacob Yankee Resume</title>";
            echo"<h1>Jacob Yankee</h1>
            <h3>Email: jyankee1@emich.edu &nbsp;&nbsp;&nbsp;&nbsp; Phone: (734) 660-7005 &nbsp;&nbsp;&nbsp;&nbsp; Address: 13240 LeBlanc, Plymouth MI 48170</h3>
            <hr>";
            echo"<div class=\"odd\">
			<h4>Education</h4>
				<ol>
					<li>Eastern Michigan University, Ypsilanti, MI
						<ul>
							<li>Fall 2022-Spring 2024</li>
							<li>Bachelors of Applied Science in Computer Science</li>
							<li>GPA: 3.61</li>
							<li>Expected Graduation: April 2024</li>
						</ul>
					</li>
					<li>Michigan Technological University, Houghton, MI
						<ul>
							<li>Fall 2019-Spring 2022</li>
							<li>Bachelors of Science in Computer Science</li>
							<li>GPA: 2.60 / Departmental: 2.12</li>
						</ul>
					</li>
				</ol>
		</div>";
        echo"<div class=\"even\">

	<hr> 
			<h4>Computer Skills</h4>
				<p>Java, C, C++, C#, MIPS, Lua, HTML, CSS, Javascript, Python, Bash, Unity, AWS</p>
	<hr>	
		</div>";
        echo"<div class=\"odd\">
			<h4>Relevant Courses</h4>
				<ul>
					<li>COSC 473: Big Data II</li>
					<li>COSC 471: Database Principles</li>
					<li>COSC 436: Web Programming</li>
					<li>COSC 381: Software Engineering Solutions</li>
					<li>COSC 311: Algorithms & Data Structures</li>
				</ul>
		</div>";
        echo"<div class=\"even\">
		<hr>
			<h4>Projects</h4>
				<ul style=\"list-style-type:none;\">

					<li>Unshuffle Sort: Created for COSC 311. A java implementation of the Unshuffle Sort algorithm.</li>
					<li>Tumblewash: Created for itch.io's \"My First Game Jam: Summer 2023\". A 3D puzzle game made from scratch in Unity over the span of two weeks. Created under an online alias.</li>
				</ul>
				<hr>
		</div>";
        echo"<div class=\"odd\">
			<h4>Professional Experience</h4>
				<ol>
					<li>First Watch, Northville MI &nbsp;&nbsp;&nbsp; Dishwasher &nbsp;&nbsp;&nbsp; Oct 2022 - Nov2022
						<ul>
							<li>Demonstrated ability to work on tasks alone or in small groups</li>
							<li>Utilized communication skills to deliver and receive dishware and cookware to kitchen</li>
							<li>Demonstrated ability to work under pressure during busy hours</li>
						</ul>
					</li>
					<li>Acts XXIX, Detroit MI &nbsp;&nbsp;&nbsp; Video Manager &nbsp;&nbsp;&nbsp; Jun 2019 - Jan 2021
						<ul>
							<li>Utilized creative thinking and problem solving skills to effectively transfer files to and from multiple websites in various file formats</li>
							<li>Demonstrated ability to work remotely at own pace to complete tasks</li>
							<li>Demonstrated communication skills with client to inform them on progress and estimated completion times</li>
						</ul>
					</li>
					<li>McDonald's, Plymouth MI &nbsp;&nbsp;&nbsp; Crew Member &nbsp;&nbsp;&nbsp; May 2020 - July 2020
						<ul>
							<li>Demonstrated teamwork skills to complete a variety of tasks</li>
							<li>Utilized decision-making skills during periods of high work demand to effectively complete all given tasks</li>
							<li>Utilized communication skills with coworkers to improve productivity</li>
						</ul>
					</li>
					<li>Busch's Fresh Food Market, Plymouth MI &nbsp;&nbsp;&nbsp; Leveler &nbsp;&nbsp;&nbsp; Aug 2018 - Oct 2018
						<ul>
							<li>Utilized organizational skills to improve customer’s shopping experience</li>
							<li>Demonstrated listening skills with customers to help find goods in the store</li>
							<li>Demonstrated ability to work on tasks alone at own pace to achieve required goals</li>
						</ul>
					</li>
				</ol>
		</div>";
        echo"<div class=\"even\">
	<hr>
			<h4>Academic Experience</h4>
				<ol style=\"list-style-type:none;\">
					<li>Husky Game Development, Houghton MI &nbsp;&nbsp;&nbsp; Unity Novice, Lua Novice &nbsp;&nbsp;&nbsp; Jan 2020 - April 2022
						<ul style=\"list-style-type:none;\">
							<li>Demonstrated ability to work alone or in groups to achieve sprint goals</li>
							<li>Utilized creative thinking to independently learn Unity, C#, and Lua</li>
							<li>Demonstrated ability to work remotely and in person on various projects</li>
						</ul>
					</li>
				</ol>
	<hr>
		</div>";
        echo"<div class=\"odd\">
			<h4>Academic Awards</h4>
				<ul>
					<li>Eastern Michigan University Dean's List Fall 2022, Spring 2023</li>
					<li>Michigan Technological University Presidential Platinum Scholar's Award</li>
					<li>Michigan Technological University Michigan Competitive Scholar Award</li>
					<li>Michigan Technological University University Student Award</li>
					<li>Michigan Technological University Supplemental University Student Award</li>
				</ul>
		</div>";
        }
		//if no match, deny access
        else
        {
            echo "<title>Access denied</title>";
            echo "<h1>Access denied.</h1>";
        }  
        ?>
    </body>
</html>

