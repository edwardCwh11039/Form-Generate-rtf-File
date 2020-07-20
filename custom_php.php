<?php

/**
 * Template Name: Custom PHP
 * 
 */
?>

<script>
		jQuery(document).ready(function () {
			var a = 0;
			jQuery('#addSkill').click(function () {
				jQuery('#skill_field').append('<div><p><input type="text" name="skill[]" /><a href="#" class="delete">Delete</a></p></div>');
			});
			jQuery('#addCareer').click(function () {
				a++;
				jQuery('#career_field').append('	<tr><td><input type="text" name="career[' + a + '][duration]" id="career_duration"></td>	<td><input type="text" name="career[' + a + '][employer]" id="career_employer"></td>	<td><input type="text" name="career[' + a + '][role]" id="career_role"></td>	<td><a href="#" class="remove">Delete</a></td></tr>');
			});
			jQuery(document).on('click', '.delete', function (e) {
				e.preventDefault;
				jQuery(this).parent('p').parent('div').remove();
			});
			jQuery(document).on('click', '.remove', function (e) {
				e.preventDefault;
				jQuery(this).parent('td').parent('tr').remove();
			});
			var x = 0;
			var y = 0;
			var z = 0;
			jQuery('#addExperience').click(function () {
				x++;
				jQuery('#experience_field').append('<tr><td><input type="text" name="experience[' + x + '][title]" id="job_title" /></td><td><input type="text" name="experience[' + x + '][employer]" id="employer" /></td><td><input type="date" name="experience[' + x + '][start]" id="job_start" /></td><td><input type="date" name="experience[' + x + '][end]" id="job_end" /></td><td><textarea name="experience[' + x + '][responsible]" rows="4" cols="70" maxlength="500" placeholder="Please write your responsibilites of work here."></textarea></td><td><a href="#" class="remove">Remove</a></td></tr>');
			});

			jQuery('#addEducation').click(function () {
				y++;
				jQuery('#education_field').append('<tr><td><input type="text" name="education[' + y + '][institution]" id="school_name" /></td><td><input type="text" name="education[' + y + '][year]" id="school_location" /></td><td><input type="text" name="education[' + y + '][code]" id="degree" /></td><td><input type="text" name="education[' + y + '][qualification]" id="qualification" /></td><td><a href="#" class="remove">Remove</a></td></tr>');
			});
			jQuery('#addCert').click(function () {
				$('#cert_field').append('<div><hr><p><textarea  name="cert[]" rows="3" cols="70" placeholder=""></textarea><a href="#" class="delete">Delete</a></p></div>');
			});
			jQuery('#addExtra').click(function () {
				z++;
				jQuery('#extra_field').append('<div><hr><p>	<select id="extraId" name="extra[' + z + '][type]"><option value="accomplishments"> Accomplishments</option>	<option value="membership"> Membership</option>	<option value="link"> Links</option>	<option value="hobbies"> hobbies</option>	<option value="additional_information"> Additional Information</option></select><input type="text" name="extra[' + z + '][input]" id="selected" /><a href="#" class="delete">Delete</a></p></div>');
			});

		});
		function extra() {
			var x = document.getElementById("extraId").value;
			if (x != "none") {
				document.getElementById("selected").innerHTML = '<input type="text" name="extra[0][input]" id="extra" />';
			} else {
				document.getElementById("selected").innerHTML = " ";
			}
		}
	</script>
<?php
    function populate_RTF($vars, $doc_file) {

        $replacements = array (	'{'  => "\{",
                               '}'  => "\}");

        $document = file_get_contents($doc_file);
        if(!$document) {
            return false;
        }

        foreach($vars as $key=>$value) {
            $search = "%%".strtoupper($key)."%%";
            foreach($replacements as $orig => $replace) {
                $value = str_replace($orig, $replace, $value);
            }
            
            $document = str_replace($search, $value, $document);
        }
        
        return $document;
    }
if ($_POST['submit']) {
    $skills = $_POST['skill'];
    $cert = $_POST['cert'];
    $extra = $_POST['extra'];
    $experience = $_POST['experience'];
    $education = $_POST['education'];

    //Personal details
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $suburb = $_POST['suburb'];
    $state = $_POST['state'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
	$about = $_POST['about'];

	    //Academic Qualification
		$educ_info="";
		foreach ($education as $educ) {
			$educ_info .= '\trowd';
			$educ_info .= '\cellx1000';
			$educ_info .= '\cellx5000';
			$educ_info .= '\intbl '.$educ['year'].' \cell';
			$educ_info .= '\intbl '.$educ['institution'].' \cell';
			$educ_info .= '\row';
			$educ_info .= '\trowd';
			$educ_info .= '\cellx1000';
			$educ_info .= '\cellx2000';
			$educ_info .= '\intbl  \cell';
			$educ_info .= '\intbl '.$educ['qualification'].' - '.$educ['code'].' \cell';
			$educ_info .= '\row';
		}
	

	$vars = array('profile'     => $about,
                  'academic' => $educ_info,
                  'qualification'  => '1210 Hancock',
                  'career' => 'Flint, MI 49449',
                  'extra'   => 'Testing1111112222223333344444');
    $new_rtf = populate_RTF($vars, "test.rtf");
    $fr = fopen('testOutput.rtf', 'w') ;
    fwrite($fr, $new_rtf);
    fclose($fr);


	header('Content-type: application/ms-word');
    header('Content-Disposition: attachment;Filename=testOutput.rtf');
	echo $new_rtf;

} else {
    echo <<< test
    <h1>Join Us Now !!!</h1>
	<form action="" method="post">
		<fieldset>
			<legend>Personal details</legend>
			<table>
				<tr>
					<td><label for="firstname">First Name </label></td><td><input type="text" name="firstname" id="firstname" /></td>
					<td><label for="lastname">Last Name </label></td><td><input type="text" name="lastname" id="lastname" /></td>
				</tr>
				<tr>
					<td><label for="suburb">Suburb </label></td><td><input type="text" name="suburb" id="suburb" /></td>
					<td><label for="state">State </label></td><td><input type="text" name="state" id="state" /></td>
				</tr>
				<tr>
					<td><label for="email">Email Address </label></td><td><input type="text" name="email" id="email" /></td>
					<td><label for="phone">Mobile Number </label></td><td><input type="text" name="phone" id="phone" /></td>
				</tr>
				
				
			</table>
			<p><label for="statement">About: </label><textarea name="about" id ="about" rows="4" cols="70" maxlength="500"placeholder="Write a short statement about yourself describing your character(eg. Hard working, good timekeeper, team player.) It should be a short paragraph pf about 4/5 lines."></textarea></p>
		</fieldset>
		<fieldset>
			<legend>Academic Qualifications</legend>
			<button type="button" name="addEducation" id="addEducation"> Add Education + </button>
			<table id="education_field" name="education_field">
				<tr>
					<th>Institution</th>
					<th>Year</th>
					<th>Code</th>
					<th>Qualification</th>
				</tr>
				<tr>
					<td><input type="text" name="education[0][institution]" id="school_name" /></td>
					<td><input type="text" name="education[0][year]" id="school_location" /></td>
					<td><input type="text" name="education[0][code]" id="degree" /></td>
					<td><input type="text" name="education[0][qualification]" id="graduation_year" /></td>
				</tr>
			</table>
		</fieldset>
		<fieldset>
			<legend>Key Skills</legend>
			<button type="button" name="addSkill" id="addSkill"> add + </button>
			<div for="skill" id="skill_field" name="skill_field">
				<p><input type="text" name="skill[]" id="skill" /></p>
			</div>
		</fieldset>
		<fieldset>
			<legend>Career Summary</legend>
			<button type="button" name="addCareer" id="addCareer"> add + </button>
			<table id="career_field" name="career_field">
				<tr>
					<th>Duration</th>
					<th>Employer</th>
					<th>Role</th>
				</tr>
				<tr>
					<th><input type="text" name="career[][duration]" id="career_duration"></th>
					<th><input type="text" name="career[][employer]" id="career_employer"></th>
					<th><input type="text" name="career[][role]" id="career_role"></th>

				</tr>
			</table>
		</fieldset>
		<fieldset>
			<legend>Professional Experience</legend>
			<button type="button" name="addExperience" id="addExperience"> Add more position + </button>
			<table id="experience_field" name="experience_field">
				<tr>
					<th>Title</th>
					<th>Company</th>
					<th>Year Start</th>
					<th>Year End</th>
					<th>Responsibilities/Achievements</th>
				</tr>
				<tr>
					<th><input type="text" name="experience[0][title]" id="job_title" /></th>
					<th><input type="text" name="experience[0][employer]" id="employer" /></th>
					<th><input type="date" name="experience[0][start]" id="job_start" /></th>
					<th><input type="date" name="experience[0][end]" id="job_end" /></th>
					<th><textarea name="experience[0][responsible]" rows="4" cols="70" maxlength="500"
							placeholder="Please write your responsibilites of work here."></textarea></th>
				</tr>
			</table>
		</fieldset>
		<fieldset>
			<legend>Certifications</legend>
			<button type="button" name="addCert" id="addCert"> Add Certificate + </button></n>
			<div id="cert_field" name="cert_field">
				<p>
					<textarea name="cert[]" rows="3" cols="70"
						placeholder="Please add the information your certifications here. For eg: Certificate of Protection officer, Responsible Service of Alcohol(RCA),Australian Driving License(Full,P,L) etc..."></textarea>
				</p>
			</div>
		</fieldset>
		<fieldset>
			<legend>Extra </legend>
			<button type="button" name="addExtra" id="addExtra"> add + </button>
			<label>Do you have anything else to add in CV: </label>
			<div name="extra_field" id="extra_field">
				<select id="extraId" name="extra[0][type]" onchange="extra()">
					<option value="none"> None</option>
					<option value="accomplishments"> Accomplishments</option>
					<option value="membership"> Membership</option>
					<option value="link"> Links</option>
					<option value="hobbies"> hobbies</option>
					<option value="additional_information"> Additional Information</option>
				</select>
				<p id="selected"></p>
			</div>
		</fieldset>
		<input type="submit" value="Submit" name="submit" />
	</form>
test;
}
?>