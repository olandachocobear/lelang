var gcm = require('node-gcm');

var apiKey = "AIzaSyBeNzGpOngozxboar5IH3YenzTuYLjAOF8";
var deviceID = "APA91bE4PjTWEDu95HAXwYaSBRoYqNQWhdbwMGYpmA19GRJMpJ4T5xJNbBlWmfqYOWU0Y57eOFI07YDx2FsCZjHA3wgT17i_4zcyF4QSPGdvIvfVAAy3RGP4zv7Kxf25Km9N6DbPfZF6";


var service = new gcm.Sender(apiKey);
var message = new gcm.Message();
/*
message.addData('title', 'Large Icon');
message.addData('message', 'Test picture.');
message.addData('image', 'http://36.media.tumblr.com/c066cc2238103856c9ac506faa6f3bc2/tumblr_nmstmqtuo81tssmyno1_1280.jpg');
message.addData('summaryText', 'The internet is built on cat pictures');
*/

message.addData('title', 'Haruka Shimazaki AKB48 Kuchibiru ni Be My Baby Theater ver photo');
//message.addData('title', 'Mayu Watanabe AKB48 Matsuri 2011 Team Ogi LTD photo');


message.addData('message', 'Your Package AWB #463321203981 has arrived.');

// Kalo priority 1, if 2 or more expanded, dia gak bisa di-expand
message.addData('priority', '1');

message.addData('style', 'picture');

message.addData('image', 'http://i.ebayimg.com/images/g/KxsAAOSw2ENW707c/s-l400.jpg');
message.addData('picture', 'http://36.media.tumblr.com/c066cc2238103856c9ac506faa6f3bc2/tumblr_nmstmqtuo81tssmyno1_1280.jpg');
//message.addData('picture', 'http://i.ebayimg.com/images/g/KxsAAOSw2ENW707c/s-l400.jpg');
//message.addData('picture', 'http://i.ebayimg.com/images/g/2vMAAOSwmmxW51AJ/s-l400.jpg');

message.addData('summaryText', '\u000C Form Feed \u000D Carriage Return \u23c3');

//message.addData('soundname', 'itchyscratchy');

message.addData('notId', 42);

/*
message.addData('actions', [
    { "icon": "handraise", "title": "RAISE", "callback": "app.emailGuests", "foreground": true},
    { "icon": "flagred48", "title": "FORFEIT", "callback": "app.snooze", "foreground": false}

]);
*/

service.send(message, { registrationTokens: [ deviceID ] }, function (err, response) {
    if(err) console.error('aw'+err);
    else    console.log('bb'+response);
});