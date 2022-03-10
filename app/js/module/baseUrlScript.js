let baseurl = "";

function setBaseUrl(url){
    baseurl = url;
}

function getBaseUrl(){
    return baseurl
}

export default{
    setBaseUrl,
    getBaseUrl
}