<main>
    <div class="container-fluid">
        <h1 class="mt-4">Archives</h1>
        
        <div class="container my-5">
            <div style="margin-bottom:10px">
                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-table mr-1"></i>Saved Query</div>
                    <div class="card-body">
                        <div class="float-right" style="margin-bottom:10px">
                            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" action="<?php echo base_url('Archives/search')?>" method="GET">
                                <div class="input-group">
                                    <input name="search" class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" value="<?php echo (isset($search))?$search:''?>" />
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                    <th scope="col">Timestamp</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Template</th>
                                    <th scope="col">...</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($data as $file){?>
                                    <tr data-toggle="modal" data-target="#exampleModal">
                                        <td><?php echo $file['timestamp']?></td>
                                        <td><?php echo $file['id']?></td>
                                        <td><?php 
                                                $tmplt = explode(',',$file['templates']);
                                                $n = 0;
                                                foreach($tmplt as $tmplt_id){
                                                    if($n>0){
                                                        echo ',';
                                                    }
                                                    echo $this->db->get_where('template',['id'=>$tmplt_id])->row()->name;
                                                    
                                                    $n += 1;
                                                }
                                            ?>
                                        </td>
                                        <td>
                                        <a href="<?php echo base_url('Generate/download/'.$file['id'])?>"><button type="button" class="btn btn-primary">Download</button></a>
                                        </td>
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
        </div>

        
        
    </div>
</main>