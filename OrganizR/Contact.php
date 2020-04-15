<?php

include "master/header.php";
require_once "master/site_stats.php"
?>
<script src="js/Contact.js">
</script>
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <h2 style="text-align: center">Contact</h2>
            </div>
        </div>
        <br>
        <br>
        <br>
        <div style="background: antiquewhite;width: 40%;margin: auto!important;border:1px dashed gray;border-radius: 30px; padding: 2%;">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" id="client-email" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" class="form-control" rows="3" placeholder="Type..."></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-dark" style="float:right" onclick="sendContact()">Send</button>
                </div>
            </div>
        </div>
    </div>
</div>