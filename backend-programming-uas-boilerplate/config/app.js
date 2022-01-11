// (function(){"use strict";var e=require("crypto"),n=require("base64url"),i=require("fs"),r=Date.now(),t=n(e.randomBytes(64));i.appendFile("./config/app.js","\n//UNIX="+r+"\n//APP_KEY="+t,function(e){if(e)throw e}),i.appendFile(".env","\n#UNIX="+r+"\n#APP_KEY="+t,function(e){if(e)throw e;process.exit(0)})}).call(this);

//UNIX=1641555159329
//APP_KEY=TUiiFEWaGz2Xh6dbNTXfrzqX1ucN7fYjqtVgRtvqyLGH9aN-n_uOMoY36x3JfvrzgdTJQwMRRp_UOa58wlGJrA
