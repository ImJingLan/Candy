<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no" />
    <title>景蓝の提问箱</title>
    <link rel="stylesheet" href="static/css/bootstrap.min.css" />
    <script src="static/js/jquery-3.6.3.min.js"></script>
    <script src="static/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="static/brand/icon.svg" alt="Logo" width="30" height="24"
                    class="d-inline-block align-text-top">
                景蓝の提问箱
            </a>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-lg my-3 p-3">
                    <div class="card-body m-3" style="text-align: center;">
                        <div class="row">
                            <h3>景蓝の提问箱</h3>
                        </div>
                        <div class="row">
                            <ul class="list-unstyled">
                                <li class="m-2">这可能是一个匿名提问箱、留言板、棉花糖......可能啥都行吧</li>
                                <li class="m-2">棉花糖提交后将清空, 请自行备份</li>
                                <textarea class="col-12 form-control overflow-auto bg-light text-dark" rows="15"
                                    oninput="getLength()" id="userContent" onchange="getLength()"></textarea>
                                <h5 class="col-12 m-1" style="color: black;"> 当前字数： <span id="userLength"
                                        style=""></span>/1024
                                </h5>
                                <button type="button" id="submitBotton"
                                    class="btn shadow col-sm-5 col-12 disabled btn-outline-secondary"
                                    data-bs-toggle="modal" data-bs-target="#submitCheckModal">
                                    Getting Status Now.... </button>

                                <button type="button" class="btn shadow col-sm-5 col-12 btn-outline-danger"
                                    data-bs-toggle="modal" data-bs-target="#clearCheckModal">
                                    清空内容</button>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="submitModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalTitle">棉花糖提交成功</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span id="modalText"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="modalBotton" onclick="clearInput()"
                        data-bs-dismiss="modal">知道了</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="submitCheckModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">确认提交你的棉花糖吗</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    请确认是否已经完成棉花糖，棉花糖在提交后将无法修改
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="userSubmit()"
                        data-bs-dismiss="modal">知道了</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="clearCheckModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">确认清空未提交的棉花糖吗</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    请确认是否清空未提交的棉花糖，这将无法恢复！！
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="clearInput()"
                        data-bs-dismiss="modal">知道了</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    function doLogin() {
        console.log("doLogin Process")
        console.log($('#loginUser').val())
        console.log($('#loginPassword').val())
        $.post("login/doLogin.php", {
            username: $('loginUser').val(),
            password: $('loginPassword').val()
        }, function(a) {
            a = JSON.parse(a);
        })
    }

    function getLength() {
        content = $('#userContent').val()
        $('#userLength').text(content.length)
        if (content.length > 0) {
            if (content.length <= 1024) {
                $('#submitBotton').attr('class', 'btn shadow col-sm-5 col-12 btn-outline-primary');
                $('#userLength').attr('style', '');
                $('#submitBotton').text("提交");
            }
            if (content.length > 1024) {
                $('#submitBotton').attr('class', 'btn shadow col-sm-5 disabled col-12 btn-outline-danger');
                $('#userLength').attr('style', 'color:red;');
                $('#submitBotton').text("字数超出限制");
            }
        } else {
            $('#submitBotton').attr('class', 'btn shadow col-sm-5 disabled col-12 btn-outline-danger');
            $('#userLength').attr('style', '');
            $('#submitBotton').text("输入内容不得为空");
        }

    }
    getLength()

    function clearInput() {
        $('#userContent').val('')
        getLength()
    }

    function userSubmit() {
        $.post("api/submit.php", {
            content: $('#userContent').val()
        }, function(a) {
            console.log(a)
            a = JSON.parse(a)
            if (a['code'] == 0) {
                $('#submitModal').modal('hide')
                $('#submitModal').modal('show')
                $('#modalTitle').text('棉花糖提交成功')
                $('#modalText').text("你的棉花糖ID(MID)为: " + a['candy_id'])
            }
        })
    }
    </script>


</body>

</html>