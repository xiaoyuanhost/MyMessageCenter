function isLogin() {
    var userId = sessionStorage.userId;
    if (userId == undefined) {
        console.log("not login");
        return false;
    } else {
        console.log("login by" + userId);
        return true;
    }
}

function getLoginToken() {
    return sessionStorage.token;
}

function getLoginUserName() {
    return sessionStorage.userName;
}

function logout() {
    sessionStorage.clear();
    location = "/loginRegister.html";
}

function delAccount() {
    var delConfirm = confirm("删除章账号后相关信息将不可恢复！！确认删除？");
    if (delConfirm == true) {
        var loginToken = getLoginToken();
        if (loginToken != undefined && loginToken != null && loginToken != '') {
            axios({
                    method: 'post',
                    url: '/api/msg/delAccount',
                    params: {
                        loginToken: loginToken
                    },
                    headers: { 'token': loginToken }
                })
                .then(function(response) {
                    console.log(response);
                    console.log(response.data);
                    console.log(response.data.code);
                    if (response.data.code == 1 && response.data.message != undefined) {
                        alert(response.data.message);
                        logout();
                    }
                })
                .catch(function(error) {
                    console.log(error);
                    alert(error);
                });
        }


    } else if (delConfirm == false) {}

}