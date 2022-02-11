<!doctype html>
    <html lang="en">
        <head> 
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="description" content="">
            <meta name="author" content="Alexander Buchman, and Bootstrap contributors">
            <meta name="generator" content="Hugo 0.84.0">
            <title>Tetris Math · Bootstrap v5.0</title>


        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script src="js/bootstrap.bundle.min.js" ></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>

        <link href="css/game.css" rel="stylesheet">

 

        </head>
    <body> 
<!-- http://biolagen.com/sites/TetMath/ --> 

    <?php 
    if(!$_GET['name']){
    ?>
        <section>
            <div class="row fill-viewport align-items-center">
                <div class="col-12 text-center">
                    <div class="form-group">
                        <label for="name">הזן את השם שלך</label>
                        <input type="text" class="form-control" name="name" id="theName"  placeholder="מה שמך ?">
                    </div>
                </div>
            </div>
        </section>
    <?php
        }else{
    ?>

    <section>
        <div class="row fill-viewport align-items-center">
            <div class="col-12 text-center">
                


                <a class="btn btn-primary btn-lg btnStart" href="#start" role="button">START</a>
            </div>
        </div>
 

        <div class="container-fluid background" id="start">
            
            <div class="row mb-4">
                <div class="col-12  text-center" id="startBtn" >
                    <div class="w-100 generated-text">
                        <Span class="generated-text w-80" id="q" >Click start!</Span>
                        <Span class="generated-text" id="a" hidden></Span>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-3 text-center">
                    <div>
                        <button type="button" id="btn1" class="btnAnswer btn btn-success p-4 mb-4 btn-lg btn-block"></button>
                    </div>

                    <div>
                        <button type="button" id="btn2" class="btnAnswer btn btn-success p-4 mb-4 btn-lg btn-block"></button>
                    </div>
  
                    <div>
                        <button type="button" id="btn3" class="btnAnswer btn btn-success p-4 mb-4 btn-lg btn-block"></button>
                    </div>

                    <div>
                        <button type="button" id="btn4" class="btnAnswer btn btn-success p-4 mb-4 btn-lg btn-block"></button>
                    </div>                    
                  
                    <div>
                        <button type="button" id="btn5" class="btnAnswer btn btn-success p-4 mb-4 btn-lg btn-block"></button>
                    </div>

                    <div>
                        <button type="button" id="btn6" class="btnAnswer btn btn-success p-4 mb-4 btn-lg btn-block"></button>
                    </div>
                </div>
                <div class="col-6">
                    <div class="maintxt">
                        <img src="resource/pig.png" class="img-fluid img-responsive" >
                        <Span class="align-items-center centered  display-4" id="shek"></Span>
                    </div>
                </div>
                <div class="col-3 text-center">
                    <div>
                        <button type="button" id="btn7" class="btnAnswer btn btn-success p-4 mb-4 btn-lg btn-block"></button>
                    </div>

                    <div>
                        <button type="button" id="btn8" class="btnAnswer btn btn-success p-4 mb-4 btn-lg btn-block"></button>
                    </div>
  
                    <div>
                        <button type="button" id="btn9" class="btnAnswer btn btn-success p-4 mb-4 btn-lg btn-block"></button>
                    </div>

                    <div>
                        <button type="button" id="btn10" class="btnAnswer btn btn-success p-4 mb-4 btn-lg btn-block"></button>
                    </div>                    
                  
                    <div>
                        <button type="button" id="btn11" class="btnAnswer btn btn-success p-4 mb-4 btn-lg btn-block"></button>
                    </div>

                    <div>
                        <button type="button" id="btn12" class="btnAnswer btn btn-success p-4 mb-4 btn-lg btn-block"></button>
                    </div>
                </div>
            </div> 
            <div class="row">
                
            </div>
        </div>
    </section>

    <?php
        }
    ?>       
    </body> 

    <script>
        window.onload = function() {
            var score = 0;
            var btnSound = new Audio("resource/mixkit-mouse-click-close-1113.wav");
            var endSound = new Audio("resource/mixkit-bomb-explosion-in-battle-2800.wav");
            var pibPng = new Audio("resource/pig.png");
            var startGame = false
            ShowMoney() 

            var startBtn = document.getElementById('startBtn')
            var q = document.getElementById('q')
            var a = document.getElementById('a')


            startBtn.addEventListener('click',StartGame,false)

            var btns = document.getElementsByClassName('btnAnswer')
            for (var i = 0; i < btns.length; i++) {
                btns[i].addEventListener('click', function(){
                    if(startGame){
                        btnSound.play();
                        if(this.innerHTML == $("#a").html()){
                            SaveMoney()
                            endSound.play();                  
                            ReloadPage();
                        }else{
                            this.classList.add('btn-danger')
                            this.classList.remove('btn-success')
                            SaveMistake();
                        }
                    }
                    
                    console.log(this.innerHTML);
                }, false);
            }

            function ReloadPage(){
                startGame = false
                q.innerHTML = 'Yes! it ' + a.innerHTML
                for (var i = 0; i < btns.length; i++) {
                    btns[i].classList.add('btn-success')
                    btns[i].classList.remove('btn-danger')
                    btns[i].innerHTML = ''
                    
                    setTimeout(StartGame,500)
                    
                }
            }

            function ShowMoney(){
                $.ajax({
                    url:"data.json", 
                    dataType: 'json', 
                    success:function(result){
                        $("#shek").html(result[0].maya)
                        console.log(result);
                    }
                });
                
            }

            function SaveMoney(){
                $("#shek").load("money.php");
            }

            function SaveMistake(){
                $("#shek").load("mistake.php");
            }

            function StartGame(){
                if(!startGame){
                    startGame = true
                    LoadGame()
                }
                    
            }

            function LoadGame() {
                $.ajax({
                    url:"reload.php", 
                    dataType: 'json',
                    success:function(result){
                        $("#q").html(result['q'])
                        $("#a").html(result['a'])
                        for (let i = 0; i < result['btns'].length; i++) {
                            $("#btn"+(i+1)).html(result['btns'][i])                            
                        }
                        console.log(result);
                        //$("#par1").html(result)
                    }
                });
            }

        }

    </script>
</html>
