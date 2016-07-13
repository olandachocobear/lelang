var gcm = require('node-gcm');

var apiKey = "AIzaSyDIJXERAIG8vcEnNAyJjQ0f3_umGQ55gR0"; // Oxen : AIzaSyAYFaI55RX3CagGceoOAZ24F3As8I1AaZc
var deviceID = "APA91bE4PjTWEDu95HAXwYaSBRoYqNQWhdbwMGYpmA19GRJMpJ4T5xJNbBlWmfqYOWU0Y57eOFI07YDx2FsCZjHA3wgT17i_4zcyF4QSPGdvIvfVAAy3RGP4zv7Kxf25Km9N6DbPfZF6";

var service = new gcm.Sender(apiKey);
var message = new gcm.Message({
    collapseKey: 'demo',
    priority: 'high',
    contentAvailable: true,
    delayWhileIdle: true,
    timeToLive: 3,
    restrictedPackageName: "com.NCS.myCargoApp",
    //dryRun: true,
    data: {
        key1: 'AWB 123431 Arrived',
        key2: 'Jam 13:21 at Surabaya'
    },
    notification: {
        title: "AWB #1233141231 has Arrived",
        icon: "ic_launcher",
        body: "Yew yew Check it out here."
    }
});

service.sendNoRetry(message, { registrationTokens: [ deviceID ] }, function (err, response) {
    if(err) console.error('aw'+err);
    else    console.log(response);
});