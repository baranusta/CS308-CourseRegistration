<script type="text/javascript">
        function checkInput(){
			var e = document.getElementById("term_input_id");
			var strUser = e.options[e.selectedIndex].value;
			if(strUser.length==6)
				return true;
			console.log(strUser);
			return false;
		}
</script>

<form action="CoursesBrowsePage.php" method="post" onsubmit="return checkInput()">
<table class="dataentrytable" summary="Table is used to present the course search criteria">
<tbody><tr>
<td class="delabel" scope="row"><label for="subj_id"><span class="fieldlabeltext">Subject: </span></label></td>
<td colspan="7" class="dedefault">
<select name="sel_subj" size="8" multiple="" id="subj_id">
<option value="*" selected>All</option>
<option value="ACC">Accounting(ACC)</option>
<option value="GR">Ac.Pract.&amp;Dev.(GR)</option>
<option value="ANTH">Anthropology(ANTH)</option>
<option value="ARA">Arabic(ARA)</option>
<option value="BP">Brand Practise(BP)</option>
<option value="CS">Computer Sci.&amp; Eng.(CS)</option>
<option value="CONF">Conf. Analysis Res.(CONF)</option>
<option value="CULT">Cultural Studies(CULT)</option>
<option value="DA">Data Analytics(DA)</option>
<option value="ECON">Economics(ECON)
</option><option value="EECS">Elect.Eng.&amp;Computer Sci.(EECS)
</option><option value="EE">Electrical Engineering(EE)
</option><option value="ETM">Energy Tech. and Manag.(ETM)
</option><option value="ENS">Engineering Sciences(ENS)
</option><option value="ENG">English(ENG)
</option><option value="ES">European Studies(ES)
</option><option value="FILM">Film Studies(FILM)
</option><option value="FIN">Finance(FIN)
</option><option value="MFIN">Finance(Master)(MFIN)
</option><option value="FRE">French(FRE)
</option><option value="GER">German(GER)
</option><option value="HART">History of Art(HART)
</option><option value="HIST">History(HIST)
</option><option value="HUM">Humanities(HUM)
</option><option value="IE">Industrial Engineering(IE)
</option><option value="IT">Information Technology(IT)
</option><option value="IF">Interfaculty Course(IF)
</option><option value="IR">International Relations(IR)
</option><option value="JAP">Japanese(JAP)
</option><option value="LAT">Latin(LAT)
</option><option value="LAW">Law(LAW)
</option><option value="LIT">Literature(LIT)
</option><option value="MJC">Majors:Informative Course(MJC)
</option><option value="MGMT">Management(MGMT)
</option><option value="MRES">Managerial Research(MRES)
</option><option value="MS">Manuf. Sys./Indust. Eng.(MS)
</option><option value="MKTG">Marketing(MKTG)
</option><option value="MAT">Materials Sci.&amp; Nano Eng.(MAT)
</option><option value="MATH">Mathematics(MATH)
</option><option value="ME">Mechatronics(ME)
</option><option value="EL">Microelectronics(EL)
</option><option value="BIO">Mol.Bio.Genetic&amp;Bioengin.(BIO)
</option><option value="NS">Natural Sciences(NS)
</option><option value="OPIM">Opera.&amp;Info. Syst. Man.(OPIM)
</option><option value="ORG">Organization(ORG)
</option><option value="PERS">Persian(PERS)
</option><option value="PHIL">Philosophy(PHIL)
</option><option value="PHYS">Physics(PHYS)
</option><option value="POLS">Political Science(POLS)
</option><option value="PROJ">Project Course(PROJ)
</option><option value="XM">Project-Exchange(XM)
</option><option value="PSY">Psychology(PSY)
</option><option value="PUBL">Public Policy(PUBL)
</option><option value="RUS">Russian(RUS)
</option><option value="SPS">Social &amp; Political Sci.(SPS)
</option><option value="SOC">Sociology(SOC)
</option><option value="SPA">Spanish(SPA)
</option><option value="TE">Telecommunications(TE)
</option><option value="TLL">Turkish Lang.&amp;Literature(TLL)
</option><option value="TS">Turkish Studies(TS)
</option><option value="TUR">Turkish(TUR)
</option><option value="VA">Vis. Arts&amp;Vis.l Comm Des.(VA)
</option><option value="VIS">Visual Studies(VIS)
</option></select>
</td>
</tr>
<tr>
<td class="delabel" scope="row"><label for="crse_id">
<span class="fieldlabeltext">CNR: </span></label>
</td>
<td colspan="7" class="dedefault"><input type="text" name="sel_crse" size="6" maxlength="5" id="crse_id"></td>
</tr>

<tr>
<td class="delabel" scope="row"><label for="term">
<span class="fieldlabeltext">Term: </span></label>
<select name="p_term" size="1" id="term_input_id">
<option value="">None
</option><option value="201402">Spring 2014-2015
</option><option value="201401">Fall 2014-2015 (View only)
</option><option value="201302">Spring 2013-2014 (View only)
</option><option value="201301">Fall 2013-2014 (View only)
</option><option value="201202">Spring 2012-2013 (View only)
</option><option value="201201">Fall 2012-2013 (View only)
</option><option value="201102">Spring 2011-2012 (View only)
</option><option value="201101">Fall 2011-2012 (View only)
</option><option value="201002">Spring 2010-2011 (View only)
</option><option value="201001">Fall 2010-2011 (View only)
</option></select>
</td>
<input type="submit" value="Class Search">
<input type="reset" value="Reset">
</form>