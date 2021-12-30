<?php
include_once 'install.php';
Installation::processInstall();
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="../resources/themes/default/css/plugin.min.css" rel="stylesheet">
    <link href="assets/css/style.css?time=<?php echo time()?>" rel="stylesheet">

    <title>Software Installation Wizard</title>
</head>
<body>

    <div class="container">
        <div class="title">
            <img src="assets/images/logo.png"/>
            <h6>Software Installation Wizard</h6>
        </div>
        <div class="steps-container clearfix">
            <div class="line"></div>
            <div class="each active step-1">
                <div class="count">1</div>
                <div class="heading">Terms of Use</div>
            </div>
            <div class="each step-2">
                <div class="count">2</div>
                <div class="heading">Server Requirements</div>
            </div>
            <div class="each step-3">
                <div class="count">3</div>
                <div class="heading">Folder&File Permissions</div>
            </div>
            <div class="each step-4">
                <div class="count">4</div>
                <div class="heading">Database Information</div>
            </div>
            <div class="each step-5">
                <div class="count">5</div>
                <div class="heading">Finished</div>
            </div>
        </div>
        <div class="steps-content">

            <div class="step-content step-1-container active">
                <div class="pane ">
                    <div class="pane-content">
                        BY DOWNLOADING, INSTALLING, COPYING, ACCESSING OR USING THIS WEB APPLICATION, YOU AGREE TO THE TERMS OF THIS END USER LICENSE AGREEMENT. IF YOU ARE ACCEPTING THESE TERMS ON BEHALF OF ANOTHER PERSON OR COMPANY OR OTHER LEGAL ENTITY, YOU REPRESENT AND WARRANT THAT YOU HAVE FULL AUTHORITY TO BIND THAT PERSON, COMPANY OR LEGAL ENTITY TO THESETERMS.<br/><br/>

                        <p><strong>LICENSE TO BE USED ON ONE (1) DOMAIN ONLY</strong></p>
                        <p>THE LICENSE IS FOR ONE WEBSITE / DOMAIN ONLY, IF YOU WANT TO USE IT ON MULTIPLE WEBSITE OR DOMAIN YOU WILL HAVE TO PURCHASE MORE LICENSE </p>

                        <h4 class="green-color">WHAT YOU CAN DO</h4>
                        <ul>
                            <li>USE ON ONE DOMAIN ONLY</li>
                            <li>MODIFY OR EDIT AS YOU WANT</li>
                            <li>YOU CAN REMOVE OR ADD FILES TO THE SCRIPT FILES </li>
                        </ul>
                        <p><strong>PLEASE NOTE : IF YOU MAKE CHANGES WHICH BREAK THE SYSTEM , WE ARE NOT RESPONSIBLE FOR THIS </strong></p>

                        <h4 class="red-color">WHAT YOU CANNOT DO</h4>
                        <ul>
                            <li>RESELL, DISTRIBUTE, GIVE AWAY OR TRADE BY ANY MEANS TO ANY THIRD PARTY OR INDIVIDUAL WITHOUT PERMISSION</li>
                            <li>USE ON MORE THAN ONE DOMAIN </li>
                        </ul>
                    </div>
                    <div class="d-grid gap-2">
                        <button onclick="return Install.go(2)" type="button" class="btn d-block btn-lg btn-primary">I AGREE, CONTINUE</button>
                    </div>
                </div>
            </div>
            <div class="step-content step-2-container">
                <div class="pane">
                    <div class="pane-content">
                        <p>Make sure your server meet the following requirements and click the continue button</p>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $continue= true; foreach(Installation::getRequirements() as $key => $info):?>
                                    <?php if(!$info['value']) $continue = false;?>
                                    <tr>
                                        <td><strong><?php echo $key?></strong></td>
                                        <td><?php echo $info['info']?></td>
                                        <td>
                                            <?php if($info['value']):?>
                                                <span class="badge bg-success rounded"><i class="bi bi-check2"></i></span>
                                            <?php else:?>
                                                <span class="badge bg-danger rounded"><i class="bi bi-x-lg"></i></span>
                                            <?php endif?>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>


                    </div>
                    <?php if($continue):?>
                        <div class="d-grid gap-2">
                            <button onclick="return Install.go(3)" type="button" class="btn d-block btn-lg btn-primary"> CONTINUE</button>
                        </div>
                    <?php else:?>
                        <div class="d-grid gap-2">
                            <button  type="button" class="btn d-block btn-lg btn-primary disabled" disabled>FIX ISSUES BEFORE CONTINUE</button>
                        </div>
                    <?php endif?>
                </div>
            </div>
            <div class="step-content step-3-container">
                <div class="pane">

                    <div class="pane-content">
                        <p>
                            Make sure the following listed folders and file has writable permissions and click the continue button
                        </p>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $continue= true; foreach(Installation::getFolders() as $key => $info):?>
                                <?php if(!$info['value']) $continue = false;?>
                                <tr>
                                    <td><strong><?php echo $key?></strong></td>
                                    <td><?php echo $info['info']?></td>
                                    <td>
                                        <?php if($info['value']):?>
                                            <span class="badge bg-success rounded"><i class="bi bi-check2"></i></span>
                                        <?php else:?>
                                            <span class="badge bg-danger rounded"><i class="bi bi-x-lg"></i></span>
                                        <?php endif?>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>


                    </div>
                    <?php if($continue):?>
                        <div class="d-grid gap-2">
                            <button onclick="return Install.go(4)" type="button" class="btn d-block btn-lg btn-primary"> CONTINUE</button>
                        </div>
                    <?php else:?>
                        <div class="d-grid gap-2">
                            <button  type="button" class="btn d-block btn-lg btn-primary disabled" disabled>FIX ISSUES BEFORE CONTINUE</button>
                        </div>
                    <?php endif?>
                </div>
            </div>
            <div class="step-content step-4-container">
                    <div class="pane">
                        <form onsubmit="return Install.finish()" action="" method="post" id="installForm">
                            <div class="pane-content no-overflow">
                                <p>Complete the following information with your Database details and admin account details</p>

                                <div class="form-floating mt-3">
                                    <input type="text" required placeholder="Database host" value="localhost" name="host" class="form-control"/>
                                    <label>Database Host</label>
                                </div>
                                <div class="form-floating mt-3">
                                    <input type="text" required placeholder="Database Name" value="" name="name" class="form-control"/>
                                    <label>Database Name</label>
                                </div>
                                <div class="form-floating mt-3">
                                    <input type="text" required placeholder="Database Username" value="" name="username" class="form-control"/>
                                    <label>Database Username</label>
                                </div>
                                <div class="form-floating mt-3">
                                    <input type="password" placeholder="Database Password" value="" name="password" class="form-control"/>
                                    <label>Database Password</label>
                                </div>
                                <div class="form-floating mt-3">
                                    <input type="text" value="3306" placeholder="Database Port" required name="port" class="form-control"/>
                                    <label>Database Port</label>
                                </div>

                                <hr/>
                                <h5>Site Info</h5>
                                <div class="form-floating mt-3">
                                    <input type="text" required placeholder="Site Title" value="" name="title" class="form-control"/>
                                    <label>Site Title</label>
                                </div>
                                <hr/>

                                <h5>Admin account info</h5>
                                <div class="form-floating mt-3">
                                    <input type="text" required placeholder="Full Name" value="" name="fullname" class="form-control"/>
                                    <label>Full Name</label>
                                </div>
                                <div class="form-floating mt-3">
                                    <input type="text" required placeholder="Email address" value="" name="email" class="form-control"/>
                                    <label>Email address</label>
                                </div>

                                <div class="form-floating mt-3">
                                    <input type="text" required placeholder="Your password" value="123456" name="user_pass" class="form-control disabled" disabled/>
                                    <label>Your Password</label>
                                </div>
                            </div>
                            <div class="d-grid gap-2">
                                <button  type="submit" class="btn d-block btn-lg btn-primary"> INSTALL & FINISH</button>
                            </div>
                        </form>

                    </div>
            </div>
            <div class="step-content step-5-container">
                <div class="pane">
                    <div class="pane-content">
                        <h3 class="green-color">Congratulations!!</h3>
                        <p>You have successfully installed the software you can click the button below to go the main site</p>
                    </div>

                    <div class="d-grid gap-2">
                        <a  href="<?php echo Installation::getRoot()?>" class="btn d-block btn-lg btn-primary"> GO TO WEBSITE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div id="loader">
    <img src="assets/images/loader.gif"/>
    <h6>Please wait!!..</h6>
</div>

<script src="../resources/themes/default/js/plugin.min.js"  ></script>
    <script src="assets/js/script.js?time=<?php echo time()?>" ></script>


</body>
</html>
