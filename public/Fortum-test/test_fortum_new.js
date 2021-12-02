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
var last_chargeFrom_txt = "";

// read txt last_charge.txt file
if (!fs.existsSync('./last_charge.txt')){
fs.writeFile('last_charge.txt', '', function (err) {
  if (err) throw err;
  console.log('last_charge.txt file created because it is not found.');
});
}

var last_chargeFrom_txt = fs.readFileSync('last_charge.txt').toString();

function takeScreenshot(){
  driver.takeScreenshot().then(
    function(image, err) {
        require('fs').writeFile('out.png', image, 'base64', function(err) {
         //   console.log(err);
        });
    }
   );

}

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

    function DateforInsert() {
    // Current date  
    let date_ob = new Date();
    let date = ("0" + date_ob.getDate()).slice(-2);
    let month = ("0" + (date_ob.getMonth() + 1)).slice(-2);
    let year = date_ob.getFullYear();
    //YYYY-MM-DD HH:MM:SS format
    //let date_now = ("00" +  month + ".00" + date  + ".00" + year);
    let date_now = (month + "-" + date + "-" + year);
    return date_now;
}

async function test_email_sending(baseUrl, last_chargeFrom_txt) {
  var status = 0;
try{
await driver.get(baseUrl);
}
catch (err) {
console.log(err);
process.exit();
}
// Username insert
sleep(7);
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
sleep(4);
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
sleep(7);
//await takeScreenshot();
// Organization button click
try{
  await driver.findElement(webdriver.By.xpath('//*[@id="root"]/section/section[1]/div/div/nav/div[4]')).click();
  var organization_log = "ORGANIZATION BUTTON PASSED";
}
catch (err){
//console.log(err);
var organization_log = err;
}
organization_log = await date_now(organization_log);
console.log(organization_log);
sleep(2);
// Close menu operation
try{
  await driver.findElement(webdriver.By.xpath('//*[@id="root"]/section/section[2]/div/div/div[2]/div[2]/div/div[2]/div/div/div[2]/div[1]/div[2]/div[15]/div/div[2]')).click();
  var close_menu_log = "CLOSE THE MENU PASSED";
}
catch (err){
//console.log(err);
var close_menu_log = err;
}
close_menu_log = await date_now(close_menu_log);
console.log(close_menu_log);
sleep(2);
// Company button click
try{
 // await takeScreenshot();
  await driver.findElement(webdriver.By.xpath('/html/body/div/section/section[2]/div/div/div[2]/div[2]/div/div[2]/div/div/div[2]/div[1]/div[2]/div[17]/div/div[1]/a/div')).click();
  var company_log = "COMPANY BUTTON PASSED";
}
catch (err){
//console.log(err);
 var company_log = err;
}
company_log = await date_now(company_log);
console.log(company_log);
sleep(2);
// Chargins session click
try{
  await driver.findElement(webdriver.By.xpath('//*[@id="root"]/section/section[2]/div/div/div[2]/div[1]/div[2]/div/div[1]/a')).click();
  sleep(2);
 await driver.findElement(webdriver.By.xpath('//*[@id="root"]/section/section[2]/div/div/div[2]/div[1]/div[2]/div/div[2]/a')).click(); 
 var charging_log = "CHARGING SESSION BUTTON PASSED";
}
catch (err){
//console.log(err);
var charging_log = err;
}
charging_log = await date_now(charging_log);
console.log(charging_log);
sleep(4);
// Last chargins session check
try{
  var start_time = await driver.findElement(webdriver.By.xpath('//*[@id="root"]/section/section[2]/div/div/div[2]/div[2]/div/div[2]/div/div/div[2]/div[1]/div[2]/div[1]/div/div[6]/span')).getText();

  if (last_chargeFrom_txt == start_time){
    //await driver.quit();
        var charging_checkLog = "NOT FOUND NEW CHARGING SESSION. EXIT";
        sleep(4);
        var status = 1;
        //await process.exit();
  }
  else {
    var charging_checkLog = "LAST CHARGING SESSION CHECKED";
  }
}
catch (err){
//console.log(err);
var charging_checkLog = err;
}
charging_checkLog = await date_now(charging_checkLog);
console.log(charging_checkLog);

if(status == 0){
// Insert dates
sleep(4);
try{
  var today = await DateforInsert();
  //console.log(today);
  // Take a screenshot
 // await takeScreenshot();
  await driver.findElement(webdriver.By.xpath('//*[@id="root"]/section/section[2]/div/div/div[2]/div[2]/div[1]/div[2]/div/div/div/div[2]/div[2]/div/input')).clear();
  sleep(2);
  await driver.findElement(webdriver.By.xpath('//*[@id="root"]/section/section[2]/div/div/div[2]/div[2]/div[1]/div[2]/div/div/div/div[2]/div[2]/div/input')).sendKeys(today);
  var insert_date_log = "INSERT DATES PASSED";
}
catch (err){
//console.log(err);
var insert_date_log = err;
}
insert_date_log = await date_now(insert_date_log);
console.log(insert_date_log);
sleep(4);
try{
 await driver.findElement(webdriver.By.xpath('//*[@id="root"]/section/section[2]/div/div/div[2]/div[2]/div[1]/div[2]/div/div/div/div[3]/div[2]/div/input')).clear();
  sleep(2);
 await driver.findElement(webdriver.By.xpath('//*[@id="root"]/section/section[2]/div/div/div[2]/div[2]/div[1]/div[2]/div/div/div/div[3]/div[2]/div/input')).sendKeys(today);
 var date =  await driver.findElement(webdriver.By.xpath('//*[@id="root"]/section/section[2]/div/div/div[2]/div[2]/div[1]/div[2]/div/div/div/div[3]/div[2]/div/input')).getAttribute('value');
//await takeScreenshot();
// await console.log(date);
  var insert_date_log_2 = "INSERT DATES PASSED";
}
catch (err){
//console.log(err);
var insert_date_log_2 = err;
}
insert_date_log_2 = await date_now(insert_date_log_2);
console.log(insert_date_log_2);
sleep(4);
// Export by select
try{
  await driver.findElement(webdriver.By.xpath('/html/body/div/section/section[2]/div/div/div[2]/div[2]/div[1]/div[2]/div/div/div/div[1]/div[2]/i')).click();
  sleep(2); 
  await driver.findElement(webdriver.By.xpath('/html/body/div/section/section[2]/div/div/div[2]/div[2]/div[1]/div[2]/div/div/div/div[1]/div[2]/div[2]/div[1]')).click();
  var exportBy_log = "EXPORT BY SESSION START DATE PASSED";
}
catch (err){
//console.log(err);
var exportBy_log = err;
}
exportBy_log = await date_now(exportBy_log);
console.log(exportBy_log);
sleep(6);
// Email sending operation
try{
  await driver.findElement(webdriver.By.xpath('//*[@id="root"]/section/section[2]/div/div/div[2]/div[2]/div[1]/div[2]/div/div/div/button')).click();
  var email_send_log = "EMAIL SENDING BUTTON PASSED";
}
catch (err){
//console.log(err);
var email_send_log = err;
}
email_send_log = await date_now(email_send_log);
console.log(email_send_log);
sleep(6);
// Email sending allert check
try{
  var allert = await driver.findElement(webdriver.By.className('Toastify__toast-body')).getText();
  allert_1 = "Email is sent to: pejic@icbtech.rs. Please allow up to one hour for the email to arrive.";
  if (allert_1 == allert){
    var email_allert_log = "EMAIL SENDING PASSED";
    //console.log("Email sent");
  }
  else {
    var email_allert_log = "EMAIL SENDING FAILED";
  }
}
catch (err){
//console.log(err);
var email_allert_log = err;
}
email_allert_log = await date_now(email_allert_log);
console.log(email_allert_log);
sleep(2);
// Last chargins session write to txt file
try{
  var last_time = await driver.findElement(webdriver.By.xpath('//*[@id="root"]/section/section[2]/div/div/div[2]/div[2]/div[2]/div[2]/div/div/div/div[1]/div[2]/div[1]/div/div[6]/span')).getText();
  //await console.log(start_time);
  fs.writeFile( "last_charge.txt", last_time, function(err){
    if(err) throw err;
  });
  var last_timeLog = "LAST TIME INSERTED IN TO TXT FILE";
}
catch (err){
//console.log(err);
var last_timeLog = err;
}
last_timeLog = await date_now(last_timeLog);
console.log(last_timeLog);
sleep(2);
//await driver.quit();
}

await driver.quit();

if(status == 0){

// Create a log file with test results when has new chargings session
var dir = './logs';

if (!fs.existsSync(dir)){
    fs.mkdirSync(dir);
}
var test_log = "";
test_log = await date_log(test_log);
test_log = dir + "/" + test_log + ".txt";
  var log_result = "--TEST LOGS--\n\n";
    var results = log_result.concat(login,'\n\n',login_2,'\n\n',login_button_log,'\n\n',organization_log,'\n\n',close_menu_log,'\n\n',company_log,'\n\n',charging_log,'\n\n',charging_checkLog,'\n\n',insert_date_log,'\n\n',insert_date_log_2,'\n\n',exportBy_log,'\n\n',email_send_log,'\n\n',email_allert_log,'\n\n',last_timeLog,'\n\n');
    fs.writeFile( test_log, results, function(err){
      if(err) throw err;
      console.log("\nLogs are saved!\n");
    });
  }
  else if (status == 1){
    // Create a log file with test results when no new chargings session
var dir = './logs';

if (!fs.existsSync(dir)){
    fs.mkdirSync(dir);
}
var test_log = "";
test_log = await date_log(test_log);
test_log = dir + "/" + test_log + ".txt";
  var log_result = "--TEST LOGS--\n\n";
    var results = log_result.concat(login,'\n\n\n',login_2,'\n\n',login_button_log,'\n\n',organization_log,'\n\n',close_menu_log,'\n\n',company_log,'\n\n',charging_log,'\n\n',charging_checkLog,'\n\n');
    fs.writeFile( test_log, results, function(err){
      if(err) throw err;
      console.log("\nLogs are saved!\n");
    });
  }

}
test_email_sending(baseUrl,last_chargeFrom_txt);
