//javascript
var fs = require("fs");
var webdriver = require('selenium-webdriver');
const chrome = require('selenium-webdriver/chrome');
// Chrome Driver in non headless mode
//var driver = new webdriver.Builder().forBrowser('chrome').build();
// Chrome Driver in headless mode
var driver = new webdriver.Builder().forBrowser('chrome')
.setChromeOptions(new chrome.Options().addArguments('--window-size=1920,1080','--headless'))
.build();

var baseUrl = "https://login.chargedrive.com/";

var lastChargingKey_txt = "";

// read txt last_charge.txt file
if (!fs.existsSync('./enableKey.txt')){
fs.writeFile('enableKey.txt', '', function (err) {
  console.log('enableKey.txt file created because it is not found.');
});
}

lastChargingKey_txt = fs.readFileSync('enableKey.txt').toString();


function sleep(milliseconds) {
    const date = Date.now();
    let currentDate = null;
    ms = milliseconds*1000;
    do {
      currentDate = Date.now();
    } while (currentDate - date < ms);
  }

  function date_now(log) {
    let date_ob = new Date();
    let date = ("0" + date_ob.getDate()).slice(-2);
    let month = ("0" + (date_ob.getMonth() + 1)).slice(-2);
    let year = date_ob.getFullYear();
    let hours = date_ob.getHours();
    let minutes = date_ob.getMinutes();
    let seconds = date_ob.getSeconds();
    //YYYY-MM-DD HH:MM:SS format
    let date_now = (year + "-" + month + "-" + date + " " + hours + ":" + minutes + ":" + seconds + " ");
    log = date_now.concat(log);
    return log;  
    }

    function date_log(log) {
      let date_ob = new Date();
      let date = ("0" + date_ob.getDate()).slice(-2);
      let month = ("0" + (date_ob.getMonth() + 1)).slice(-2);
      let year = date_ob.getFullYear();
      let hours = date_ob.getHours();
      let minutes = date_ob.getMinutes();
      let seconds = date_ob.getSeconds();
      //YYYY-MM-DD HH:MM:SS format
      let date_now = (year + "-" + month + "-" + date + "-" + hours + ":" + minutes + ":" + seconds);
      log = date_now.concat(log);
      return log;  
      }

async function test_email_sending(lastChargingKey_txt) {
// Current date
var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();
today = "00" + yyyy + "." + mm + "." + dd;
await driver.get(baseUrl);
sleep(2);
var status = 0;
// Username insert
  try{
    await driver.findElement(webdriver.By.name('email')).sendKeys('pejic@icbtech.rs');
    var login = "USERNAME PASSED";
}
catch (err){
  //console.log(err);
  var login = err;
}
login = await date_now(login);
console.log(login);
// Password insert
sleep(2);
try{
  await driver.findElement(webdriver.By.name('password')).sendKeys('bRJWw91kRi#!');
  var login_2 = "PASSWORD PASSED";
}
 catch (err){
 //console.log(err);
 var login_2 = err;
 }
 login_2 = await date_now(login_2);
 console.log(login_2);
// Login button click
sleep(2);
try{
  await driver.findElement(webdriver.By.xpath('/html/body/div/div[2]/div/form/div[4]/button')).click();
  var login_button_log = "LOGIN BUTTON PASSED";
}
catch (err){
//console.log(err);
var login_button_log = err;
}
login_button_log = await date_now(login_button_log);
console.log(login_button_log);
sleep(5);
// Menu open click
try{
  await driver.findElement(webdriver.By.xpath('//*[@id="root"]/section/section[1]/div/div/nav/a')).click();
  var menu_open_log = "MENU OPEN BUTTON PASSED";
}
catch (err){
//console.log(err);
var menu_open_log = err;
}
menu_open_log = await date_now(menu_open_log);
console.log(menu_open_log);
sleep(2);
// Open menu dropdown
try{
  await driver.findElement(webdriver.By.xpath('//*[@id="root"]/section/section[1]/div/div/nav/div[3]/div/div')).click();
  var dropdown_log = "DROPDOWN OPEN PASSED";
}
catch (err){
//console.log(err);
var dropdown_log = err;
}
dropdown_log = await date_now(dropdown_log);
console.log(dropdown_log);
sleep(2);
// Charging keys button click
try{
  await driver.findElement(webdriver.By.xpath('//*[@id="root"]/section/section[1]/div/div/nav/div[3]/div[2]/a[3]/div')).click();
  var keys_button_log = "CHARGING KEYS BUTTON PASSED";
}
catch (err){
//console.log(err);
 var keys_button_log = err;
}
keys_button_log = await date_now(keys_button_log);
console.log(keys_button_log);
sleep(4);
// If there is an new keynumber in the list*******************************
if(status == 0){
  var i = 0;
  var j = 1;
  while (i<j){
    enabled = true;
    try{
      var keyCheck = await driver.findElement(webdriver.By.xpath('//*[@id="root"]/section/section[2]/div/div/div[2]/div[2]/div[2]/div[2]/div/div/div/div[1]/div[2]/div[' + j +']/div/div[3]')).getText();
      if(keyCheck == lastChargingKey_txt || lastChargingKey_txt == ""){
        var insertKey_log = "NOT FOUND NEW KEY NUMBER. EXIT";
            ++i;
      }
      else {
// Name click
try{
  await driver.findElement(webdriver.By.xpath('//*[@id="root"]/section/section[2]/div/div/div[2]/div[2]/div[2]/div[2]/div/div/div/div[1]/div[2]/div[' + j + ']/div/div[1]')).click();
  var keyOpen_log = "CHARGING KEY OPEN PASSED";
}
catch (err){
//console.log(err);
var keyOpen_log = err;
}
keyOpen_log = await date_now(keyOpen_log);
console.log(keyOpen_log);
sleep(4);
// Enabled or disabled check
try{
    var enabled = await driver.findElement(webdriver.By.xpath('//*[@id="root"]/section/section[2]/div/div/div[2]/div[2]/div[1]/div[2]/div/div/div[6]/div[2]')).getText();
    if (enabled == "Yes"){
        enabled = false;
        sleep(4);
        var enableCheck_log = "CHARGING KEY ENABLED. NOT EDIT.";
    } else{
    var enableCheck_log = "CHARGING KEY DISABLED. CONTINUE";
    }
  }
  catch (err){
  //console.log(err);
  var enableCheck_log = err;
  }
  enableCheck_log = await date_now(enableCheck_log);
  console.log(enableCheck_log);
  sleep(4);
  if(enabled){
// Edit click
try{
    await driver.findElement(webdriver.By.xpath('//*[@id="root"]/section/section[2]/div/div/div[2]/div[2]/div[1]/div[1]/span/div/div/span')).click();
    var editClick_log = "OPEN EDIT PAGE PASSED";
  }
  catch (err){
  //console.log(err);
  var editClick_log = err;
  }
  editClick_log = await date_now(editClick_log);
  console.log(editClick_log);
  sleep(2);
// Enable checkmark
try{
    await driver.findElement(webdriver.By.xpath('//*[@id="root"]/section/section[2]/div/div/div[2]/div[2]/div[1]/div[2]/div/div/form/div[7]/div[2]/div[1]/div')).click();
    var checked_log = "CHECKMARK PASSED";
  }
  catch (err){
  //console.log(err);
  var checked_log = err;
  }
  checked_log = await date_now(checked_log);
  console.log(checked_log);
  sleep(2);
  // Save button click
try{
    await driver.findElement(webdriver.By.xpath('//*[@id="root"]/section/section[2]/div/div/div[2]/div[2]/div[1]/div[2]/div/div/form/div[11]/button[2]')).click();
    var save_log = "SAVE BUTTON PASSED";
  }
  catch (err){
  //console.log(err);
  var save_log = err;
  }
  save_log = await date_now(save_log);
  console.log(save_log);
  sleep(2);
  // Save check
  try{
    var allert = await driver.findElement(webdriver.By.className('Toastify__toast-body')).getText();
    allert_1 = "Charging key successfully updated";
    if (allert_1 == allert){
      var saveCheck_log = "SAVE OPERATION PASSED";
      //console.log("Charging key saved");
    }
    else {
      var saveCheck_log = "SAVE OPERATION FAILED";
    }
  }
  catch (err){
  //console.log(err);
  var saveCheck_log = err;
  }
  saveCheck_log = await date_now(saveCheck_log);
  console.log(saveCheck_log);
  sleep(2);
  // Enabled or disabled check
try{
    var enabled = await driver.findElement(webdriver.By.xpath('//*[@id="root"]/section/section[2]/div/div/div[2]/div[2]/div[1]/div[2]/div/div/div[6]/div[2]')).getText();
    if (enabled == "Yes"){
     var enableDisable_log = "CHARGING KEY ENABLED";
    }
    else {
        var enableDisable_log = "CHARGING KEY DISABLED";
    }
  }
  catch (err){
  //console.log(err);
  var enableDisable_log = err;
  }
  enableDisable_log = await date_now(enableDisable_log);
  console.log(enableDisable_log);
  sleep(4);
}
  // Go back to Charging keys
  try{
   // await driver.findElement(webdriver.By.xpath('//*[@id="root"]/section/section[1]/div/div/nav/a')).click();
    sleep(2);
    await driver.findElement(webdriver.By.xpath('//*[@id="root"]/section/section[1]/div/div/nav/div[3]/div/div')).click();
    sleep(2);
    await driver.findElement(webdriver.By.xpath('//*[@id="root"]/section/section[1]/div/div/nav/div[3]/div[2]/a[3]/div')).click();
    sleep(2);
  }
  catch (err){
    console.log(err);
  }
      }
    }
    catch (err){
    console.log(err);
    //var insertKey_log = err;
    }
    ++i;
    ++j;
  }
  }
  sleep(3);
// Save the new key number
try{
  var keyNumberDisabled = await driver.findElement(webdriver.By.xpath('//*[@id="root"]/section/section[2]/div/div/div[2]/div[2]/div[2]/div[2]/div/div/div/div[1]/div[2]/div[1]/div/div[3]')).getText();
}
catch (err){
console.log(err);
}
sleep(2);

await driver.quit();

if (status == 0){
/*// Create a log file with test results
var dir = './rfid_enabled_logs';

if (!fs.existsSync(dir)){
    fs.mkdirSync(dir);
}
var test_log = "";
test_log = await date_log(test_log);
test_log = dir + "/" + test_log + ".txt";
  var log_result = "--TEST LOGS--\n\n";
    var results = log_result.concat(
        login,'\n\n\n',
        login_2,'\n\n',
        login_button_log,'\n\n',
        menu_open_log,'\n\n',
        dropdown_log,'\n\n',
        keys_button_log,'\n\n',
        insertKey_log,'\n\n',
        keyOpen_log,'\n\n',
        enableCheck_log,'\n\n',
        editClick_log,'\n\n',
        checked_log,'\n\n',
        save_log,'\n\n',
        saveCheck_log,'\n\n',
        enableDisable_log,'\n\n'
        );
    fs.writeFile( test_log, results, function(err){
        if(err) {
            console.log(err);
        };
      console.log("\nLogs are saved!\n");
    });*/

     //console.log(keyNumberDisabled);
  }
  else if (status == 1){
    // Create a log file with test results
/*var dir = './rfid_disabled_logs';

if (!fs.existsSync(dir)){
    fs.mkdirSync(dir);
}
var test_log = "";
test_log = await date_log(test_log);
test_log = dir + "/" + test_log + ".txt";
  var log_result = "--TEST LOGS--\n\n";
    var results = log_result.concat(
        login,'\n\n\n',
        login_2,'\n\n',
        login_button_log,'\n\n',
        menu_open_log,'\n\n',
        dropdown_log,'\n\n',
        keys_button_log,'\n\n',
        insertKey_log,'\n\n'
        );
    fs.writeFile( test_log, results, function(err){
        if(err) {
            console.log(err);
        };
      console.log("\nLogs are saved!\n");
    });*/
  }
}
test_email_sending(lastChargingKey_txt);
