<footer id="footer" class="footer" data-background-color="black">

    <div class="container">
        <nav>
            <ul>
                <li>
                    <a href="<?php echo e(route("setAr")); ?>">
                        العربية
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route("setEn")); ?>">
                        English
                    </a>
                </li>
            </ul>
        </nav>
        <div class="copyright" id="copyright">
            ©
            <script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script>
            , Designed by <a href="" target="_blank">Approc</a>.
        </div>
    </div>


</footer>