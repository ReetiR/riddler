            var howClose, ques, txtbx, hint, tint, hintbody;

            tint = document.getElementById('tint');
            txtbx = document.getElementById('ans');
            qm = document.getElementById('questionmark');
            hint = document.getElementById('hint');
            ques = 2; hintbody = "";

            window.onload = function () {
                if (hintbody != "") {
                    document.getElementById('showhint').style.visibility = "visible";
                    document.getElementById('nohint').style.visibility = "hidden";
                }
            }

            qm.onmouseover = function () {
                qm.style.left = "10px"
            }

            qm.onmouseout = function () {
                qm.style.left = "-88px"
            }

            document.getElementById('hintSwitch').onclick = function () {
                hint.style.height = "230px";
                tint.style.visibility = "visible";
                hint.style.visibility = "visible";
                tint.style.opacity = "0.9";
                hint.style.opacity = "1";
            }

            function closeHintsDiag() {
                tint.style.opacity = "0";
                hint.style.height = "0";
                hint.style.opacity = "0";
                tint.style.visibility = "hidden";
                hint.style.visibility = "hidden";
            }

            function enterer(e) {
                if (e.keyCode == 13)
                    document.getElementById('subBtn').click();
            }

            function check(answer) {
                var req = new XMLHttpRequest();
                req.onreadystatechange = function () {
                    if (req.readyState == 4 && req.status == 200) {
                        document.getElementById('closeness').innerHTML = req.responseText.substring(1);
                        if (req.responseText.charAt(0) == 1)
                            wrongAns();
                        else
                            correctAns();
                    }
                }

                req.open("GET", "verify.php?q=" + ques + "&a=" + answer, true);
                req.send();
            }

            function buyHint() {
                var req = new XMLHttpRequest();
                req.onreadystatechange = function () {
                    if (req.readyState == 4 && req.status == 200) {
                        hintbody = req.responseText;
                        document.getElementById('hintText').innerHTML = hintbody;
                        document.getElementById('nohint').style.opacity = "0";
                        document.getElementById('showhint').style.visibility = "visible";
                        document.getElementById('showhint').style.opacity = "1";
                        document.getElementById('nohint').style.visibility = "hidden";
                    }
                }

                req.open("GET", "hint.php?q=" + ques, true);
                req.send();
            }

            function wrongAns() {
                txtbx.style.backgroundColor = "crimson";
                txtbx.style.border = "1px solid maroon";
                txtbx.style.color = "#fff";
                txtbx.style.animationPlayState = "running";
                txtbx.style.WebkitAnimationPlayState = "running";
                setTimeout(stopAnim, 1300);
            }

            function correctAns() {
                txtbx.style.backgroundColor = "#00cc00";
                txtbx.style.border = "1px solid #009900";
                txtbx.style.color = "#fff";
                txtbx.style.textAlign = "center";
                txtbx.setAttribute("disabled", "disabled");
                document.getElementById('subBtn').style.left = "195px";
                document.getElementById('nextqLink').style.visibility = "visible";
                setTimeout(viewNextqLink, 600);

            }
            
            function viewNextqLink(){
                document.getElementById('nextqLink').style.opacity = "1";
            }
            
            function stopAnim() {
                txtbx.style.animationPlayState = "paused";
                txtbx.style.WebkitAnimationPlayState = "paused";
                txtbx.style.backgroundColor = "#fff";
                txtbx.style.border = "1px solid grey";
                txtbx.style.color = "#000";
                var newtxtbx = txtbx.cloneNode(false);
                document.getElementById('ansForm').replaceChild(newtxtbx, txtbx);
                txtbx = document.getElementById('ans');
                txtbx.select();
            }