
<font face="oxygen">
<!-- table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
          <tr>
            <td valign="top" class="contentbody"> 
                        
                        <form id="sampleform" name="sampleform" method="post" action="index.php" style="margin-bottom:auto;" 
                         onSubmit="return checkingcontact();">
<input type="hidden" name="mode" value="1" />
<table width="93%" border="0" align="center" cellpadding="2" cellspacing="4">


 			<tr>
              <td   colspan="3" align="left" valign="middle"  style="color:#F00;"  >
			  <?php if(!empty($message))
					{
					echo $message;
					}
					else
					{
					echo "";	
					}
				?>
                </td>
            </tr>
            
            
            
            <tr>
              <td height="35" colspan="3" align="left" valign="middle" class="heading" style="font-weight:bold; font-size:25px; padding-left:21px;">Registration</td>
            </tr>
                        
            <tr>
              <td width="32%" align="left" valign="middle" class="contact">Username:</td>
              <td width="68%" colspan="2"><input type="text" name="username" id="username" style="width:250px; height:20px;" /></td>
            </tr>
            <tr>
              <td align="left" valign="middle" class="contact">Registration Number:</td>
              <td colspan="2"><input type="text" name="reg_no"  id="reg_no" style="width:250px; height:20px;" /></td>
            </tr>
           
            <tr>
              <td align="left" valign="middle" class="contact">Phone no:</td>
              <td colspan="2"><input type="text" name="phoneno" id="phoneno" style="width:250px; height:20px;" /></td>
            </tr>
            <tr>
              <td align="left" valign="middle" class="contact">Email Address:</td>
              <td colspan="2"><input type="text" name="emailadd" id="emailadd" style="width:190px; height:20px;" />@vit.ac.in</td>
               
            </tr>
            
             <tr>
              <td align="left" valign="middle" class="contact"  >Password:</td>
              <td colspan="2"><input type="password" name="passwordadd" id="passwordadd" style="width:250px; height:20px;" /></td></tr>
              
              <tr>
              <td align="left" valign="middle" class="contact"  >Confirm Password:</td>
              <td colspan="2"><input type="password" name="passwordcon" id="passwordcon" style="width:250px; height:20px;" /></td></tr>         
            
            
            
 

         <tr>
              <td height="108">&nbsp;</td>
              <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                     
                    <td width="100%"><input type="image" name="imageField2" src="images/submit.gif" style="border:none;" /></td>
                  </tr>
              </table></td>
            </tr>
          </table>
                  </form>
                                      </td>
          </tr>
        </table -->
<div>
       <form id="sampleform" name="sampleform" method="post" action="index.php" 
       style="margin-bottom:auto;" onSubmit="return checkingcontact();">
      
       <fieldset>
       
       <legend>Registration</legend>
           
           <br>

          <!-- <?php if(!empty($message))
          {
          echo $message;
          }
          else
          {
          echo "";  
          } ?>

        -->
        <input type="hidden" name="mode" value="1" />
        
        <label for="name" class="contact">Name: </label><input name="name" id="name" required autofocus /><br/>

       <label for="reg_no" class="contact">Registration Number: </label><input name="reg_no" id="reg_no" required autofocus /><br/>


       <label for="phoneno" class="contact">Phone Number: </label><input name="phoneno" id="phoneno" 
          type="Number" pattern="[0-9]{10}" maxlength="10" title="Enter your mobile phone number." required /><br/>

       <label for="emailadd" class="contact">Email Address: </label><input name="emailadd" 
          id="emailadd" type="text" required  />@vit.ac.in<br/>
       
       <label for="passwordadd" class="contact">Password: </label><input name="passwordadd" id="passwordadd" required type = "password"/><br/>
       <label for="passwordcon" class="contact">Confirm Password: </label><input id="passwordcon" name="passwordcon" required type = "password"/><br/>
       
       <label for="captcha" class="contact"> <?php echo recaptcha_get_html($publickey, $error); ?></label>
       
     
       
       <br/>
       
       <input type="submit" value="Register" id="subBtn" class="buttons"/> 
       <input type="reset" value="Reset"id = "resetBtn"/>
      
      </fieldset>
       </form>
    </div>
		</font>