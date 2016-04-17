var http = require('http');

http.createServer(function(request, response) {

    response.writeHead(200,
        {'Content-Type': "text/plain"}
    );

    var content = 'A voice from the past.\n';

    response.end(content);

}).listen(3000);