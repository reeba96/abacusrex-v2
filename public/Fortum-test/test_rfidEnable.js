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
var runningStatusFolder = __dirname + "/";

const keynumberReceive = process.argv.slice(2);
console.log(keynumberReceive.toString());

var disabledKeyNumber = "";
var disabledKeyNumber = keynumberReceive.toString();
var a = 0;
var b = 1;
var runningStatus = "";

while(a<b) {
runningStatus = fs.readFileSync(runningStatusFolder + 'running_status.txt').toString();
runningStatus = runningStatus.replace(/\s/g, '');
if(runningStatus == "false") {
++a;
console.log("Test is starting ...");
}
else if (runningStatus == "true"){
process.exit(3);
}
++a;
++b;
}


//var disabledKeyNumber = "";

//disabledKeyNumber = fs.readFileSync('keyNumber_disabled.txt').toString();

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

async function test_email_sending(disabledKeyNumber) {
// Current date
var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();
today = "00" + yyyy + "." + mm + "." + dd;
var status = 0;

fs.writeFile(runningStatusFolder + 'running_status.txt', 'true', function (err) {
  console.log('running_status.txt updated');
});


await driver.get(baseUrl);
sleep(4);
// Username insert
  try{
    await driver.findElement(webdriver.By.name('email')).sendKeys('pejic@icbtech.rs');
    var login = "USERNAME PASSED";
}
catch (err){
  //console.log(err);
  var login = err;
  process.exitCode = 1;
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
 process.exitCode = 1;
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
process.exitCode = 1;
}
login_button_log = await date_now(login_button_log);
console.log(login_button_log);
sleep(7);
// Menu open click
try{
  await driver.findElement(webdriver.By.xpath('//*[@id="root"]/section/section[1]/div/div/nav/a')).click();
  var menu_open_log = "MENU OPEN BUTTON PASSED";
}
catch (err){
//console.log(err);
var menu_open_log = err;
process.exitCode = 1;
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
process.exitCode = 1;
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
 process.exitCode = 1;
}
keys_button_log = await date_now(keys_button_log);
console.log(keys_button_log);
sleep(2);
// Insert key
try{
  await driver.findElement(webdriver.By.xpath('//*[@id="root"]/section/section[2]/div/div/div[2]/div[2]/div[1]/div[1]/div[2]/div/input')).sendKeys(disabledKeyNumber);
  var insertKey_log = "SEARCH FOR KEY PASSED";
}
catch (err){
//console.log(err);
var insertKey_log = err;
process.exitCode = 1;
}
insertKey_log = await date_now(insertKey_log);
console.log(insertKey_log);
sleep(4);
// Name click
try{
  await driver.findElement(webdriver.By.xpath('//*[@id="root"]/section/section[2]/div/div/div[2]/div[2]/div[2]/div[2]/div/div/div/div[1]/div[2]/div[1]/div/div[1]')).click();
  var keyOpen_log = "CHARGING KEY OPEN PASSED";
}
catch (err){
//console.log(err);
var keyOpen_log = err;
process.exitCode = 1;
}
keyOpen_log = await date_now(keyOpen_log);
console.log(keyOpen_log);
sleep(4);
// Enabled or disabled check
try{
    var enabled = await driver.findElement(webdriver.By.xpath('//*[@id="root"]/section/section[2]/div/div/div[2]/div[2]/div[1]/div[2]/div/div/div[6]/div[2]')).getText();
    var enableCheck_log = "CHARGING KEY DISABLED. CONTINUE";
    if (enabled == "Yes"){
        await driver.quit();
        var enableCheck_log = "ALREADY ENABLED. EXIT";
       //await console.log(enableCheck_log);
        sleep(4);
       // await process.exit(status);
       process.exitCode = 2;
       status = 1;
    }
  }
  catch (err){
  //console.log(err);
  var enableCheck_log = err;
  }
  enableCheck_log = await date_now(enableCheck_log);
  console.log(enableCheck_log);
  sleep(2);
if(status == 0){
// Edit click
try{
    await driver.findElement(webdriver.By.xpath('//*[@id="root"]/section/section[2]/div/div/div[2]/div[2]/div[1]/div[1]/span/div/div/span')).click();
    var editClick_log = "OPEN EDIT PAGE PASSED";
  }
  catch (err){
  //console.log(err);
  var editClick_log = err;
  process.exitCode = 1;
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
  process.exitCode = 1;
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
  process.exitCode = 1;
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
      process.exitCode = 1;
    }
  }
  catch (err){
  //console.log(err);
  var saveCheck_log = err;
  process.exitCode = 1;
  }
  saveCheck_log = await date_now(saveCheck_log);
  console.log(saveCheck_log);
  sleep(2);
  // Enabled or disabled check
try{
    var enabled = await driver.findElement(webdriver.By.xpath('//*[@id="root"]/section/section[2]/div/div/div[2]/div[2]/div[1]/div[2]/div/div/div[6]/div[2]')).getText();
    if (enabled == "Yes"){
     var enableDisable_log = "CHARGING KEY ENABLED";
     status = 1;
    }
    else {
        var enableDisable_log = "CHARGING KEY DISABLED";
        process.exitCode = 1;
    }
  }
  catch (err){
  //console.log(err);
  var enableDisable_log = err;
  process.exitCode = 1;
  }
  enableDisable_log = await date_now(enableDisable_log);
  console.log(enableDisable_log);
  sleep(6);
await driver.quit();
}

// Create a log file with test results
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
    });

   /* if(status == 1){
      await process.exit(1);
    }*/

fs.writeFile(runningStatusFolder + 'running_status.txt', 'false', function (err) {
  console.log('running_status.txt file updated');
});

}
test_email_sending(disabledKeyNumber);
