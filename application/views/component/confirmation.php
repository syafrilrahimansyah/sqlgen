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
    background: #455A64;
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
#progressbar li.done:before,
#progressbar li.done:after {
    background: green
}
</style>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Generate</h1>
        
        <div class="container my-5">
            <ul id="progressbar" class="text-center">
                <li class="done" id="step1"><div class="d-none d-md-block">Template Selection</div></li>
                <li class="done" id="step4"><div class="d-none d-md-block">Upload Extract</div></li>
                <li class="active" id="step5"><div class="d-none d-md-block">Confirmation</div></li>
                <li class="" id="step6"><div class="d-none d-md-block">Result</div></li>
            </ul>
            <div style="margin-bottom:10px">
                <?php echo 'found <b>'.$fault_count.'</b> issue';?>
                <?php
                    if($dt_fault_msg!=[]){ 
                    foreach($dt_fault_msg as $msg){?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $msg?>
                    </div>
                <?php }}?>
                <?php
                    if($mp_fault_msg!=[]){ 
                    foreach($mp_fault_msg as $msg){?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $msg?>
                    </div>
                <?php }}?>
                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-table mr-1"></i>Extract Rows</div>
                    <div class="card-body">
                        
                        
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                    <th scope="col">Row ID</th>
                                    <th scope="col">Default Name</th>
                                    <th scope="col">Process ID</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($extract_data as $extract){?>
                                    <tr>
                                    <th scope="row"><?php echo $extract['data_id']?></th>
                                    <td><?php echo $extract['default_name']?></td>
                                    <td><?php echo $extract['proc_id']?></td>
                                    </tr>
                                <?php }?>
                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                Total row - <?php echo $total_row?>
                            </div>
                            <div class="col-md-6">
                                <div class="float-right">
                                    <nav aria-label="Page navigation example ">
                                    <?php echo $pagination?>
                                    
                                    </nav>
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <form action="<?php echo base_url('Generate/exec_generate')?>" method="POST">
                
                <a href="<?php echo base_url('generate/pre_upload')?>"><button type="button" class="btn btn-primary"><< Back</button></a>
                <?php if($fault_count==0){?>
                    <input type="text" value="<?php echo $proc_id?>" name="proc_id" hidden>
                    <button type="submit" class="btn btn-primary">Next >></button>
                <?php }else{?>
                    <button type="button" class="btn btn-secondary" disabled>Next >></button>
                <?php }?>
            </form>
            
        </div>

        
        
    </div>
</main>