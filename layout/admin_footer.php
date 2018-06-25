
<footer class="page-footer blue center-on-small-only">

    <!--Footer Links-->
    <div class="container-fluid">
        <div class="row">

            <!--First column-->
            <div class="col-md-6">
                <h5 class="title">Footer Content</h5>
                <p>Here you can use rows and columns here to organize your footer content.</p>
            </div>
            <!--/.First column-->

            <!--Second column-->
            <div class="col-md-6">
                <h5 class="title">Links</h5>
                <ul>
                    <li><a href="#!">Link 1</a></li>
                    <li><a href="#!">Link 2</a></li>
                </ul>
            </div>
            <!--/.Second column-->
        </div>
    </div>
    <!--/.Footer Links-->

    <!--Copyright-->
    <div class="footer-copyright">
        <div class="container-fluid">
            © <?= date('Y');?> Copyright: <a href=""> yogiraj@fierydevs.com </a>

        </div>
    </div>
    <!--/.Copyright-->

</footer>

    </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="script/bootstrap.min.js"></script>
        <script>
            $('.custombtn2').click(function(){
                $('#myModal').modal();
            });
            $('.custombtn5').click(function(){
                window.location.href='logout.php';
            });
            $('.custombtn3').click(function(){
                window.location.href='signup.php';
            });
            $('.custombtn1').click(function(){
                window.location.href='index.php';
            });
            /*trash
            !elt.hasChildNodes()
            !$(elt)[0].hasChildNodes()
            */
            function singleprod(n){
                window.location.href='productsingle.php?id='+n;
            };
        </script>
  </body>
</html>
