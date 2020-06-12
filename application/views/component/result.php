<style>

#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: #455A64;
    padding-left: 0px;
    margin-top: 30px
}

#progressbar li {
    list-style-type: none;
    width: 16.66%;
    float: left;
    position: relative;
    font-weight: 400
}

#progressbar #step1:before {
    content: "1";
}

#progressbar #step2:before {
    content: "2";
}

#progressbar #step3:before {
    content: "3";
}
#progressbar #step4:before {
    content: "4";
}
#progressbar #step5:before {
    content: "5";
}
#progressbar #step6:before {
    content: "6";
}

#progressbar li:before {
    width: 40px;
    height: 40px;
    line-height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    background: green;
    border-radius: 50%;
    margin: auto;
    color: #fff;
}

#progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: #455A64;
    position: absolute;
    left: 0;
    top: 21px;
    z-index: -1
}

#progressbar li:last-child:after {
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
    position: absolute;
    left: -50%
}

#progressbar li:first-child:after {
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
    position: absolute;
    left: 50%
}

#progressbar li:last-child:after {
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px
}

#progressbar li:first-child:after {
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px
}

#progressbar li.active:before,
#progressbar li.active:after {
    background: red
}

</style>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Generate</h1>
        
        <div class="container my-5">
            <ul id="progressbar" class="text-center">
                <li class="done" id="step1"><div class="d-none d-md-block">Template Selection</div></li>
                <li class="done" id="step2"><div class="d-none d-md-block">Upload Extract</div></li>
                <li class="done" id="step3"><div class="d-none d-md-block">Confirmation</div></li>
                <li class="active" id="step4"><div class="d-none d-md-block">Result</div></li>
            </ul>
            <div style="margin-bottom:10px">
                <div class="alert alert-success" role="alert">
                    <?php echo 'query generated as <b>'.$proc_id.'.sql</b> '?>
                </div>
            </div>
            <a href="<?php echo base_url('Generate/download/'.$proc_id)?>"><button type="button" class="btn btn-primary">Download</button></a>
        </div>

        
        
    </div>
</main>