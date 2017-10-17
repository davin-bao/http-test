This is a tool to test HTTP Communication

# Installation
1. clone the project to client and server;
2. set virtual host to ./server.php in server;
    
## Run Test
1. run command in client:

```
    php client.php ${your_server_url} 2 5 true
```
2. copy the client_data.json to server dir;
3. view ${your_server_url}/result.html to see the result;

## command arguments 

```
php client.php ${your_server_url} ${user_count} ${request_count} ${is_post}

${your_server_url}: test server address
${user_count}: how many user request sametims
${request_count}: request count per user
${is_post}: if is "true", it will post a image names 'example.jpg' to server, if not, it will send get request.
```

When get a post request, server will find 'img' field and save the image to '/upload/' directory, if not, it will sleep between 0 and 10 second.

## result 

```
RequestTime： client to server to lost time (s)
ServerLostTime： dispose business lost time (s)
ResponseTime： server to client to lost time (s)
```





