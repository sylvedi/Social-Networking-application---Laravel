@extends('layouts.app') @section('styles')
<style>
label {
	color: gray;
}
</style>
@endsection @section('content')
  <div>
        <div class="container-fluid">
            <h1 style="font-size: 19px;">Job post</h1>
            
        </div>
    </div>
    <section id="contact" style="padding:40px;padding-right:5px;padding-left:4px;">
        <div class="container">
            <form id="contactForm" style="padding:15px;" action="javascript:void();" method="post">
                <div class="form-row">
                    <div class="col" style="width: 1042px;padding: 159px;padding-top: 36px;">
                        <div style="height: 209px;background-image: url(&quot;assets/img/bg-pattern.png&quot;);margin-bottom: 122px;background-color: #333131;">
                            <div class="col-md-4 relative">
                                <div class="avatar" style="margin-top: 115px;">
                                    <div class="avatar-bg center" style="height: 136px;width: 136px;"></div>
                                </div><input type="file" class="form-control" name="avatar-file"></div>
                        </div>
                        <fieldset></fieldset>
                        <div class="form-group has-feedback">
                        <label for="from_name" style="margin-left: 1px;">Company&nbsp;</label>
                        <label for="from_name" style="margin-left: 396px;">Job title</label>
                        <input class="form-control" type="text" id="from_name" tabindex="-1" name="from_name" required="" placeholder="Ex: Grand Canyon University" style="width: 339px;height: 58px;">
                        <input class="form-control" type="text" id="from_name" tabindex="-1" name="from_name" required="" placeholder="Job title" style="width: 339px;height: 58px;margin-left: 460px;margin-top: -59px;">
                        </div>
                        <div class="form-group has-feedback">
                            <label for="from_name">Location</label>
                            <input class="form-control" type="text" id="from_name" tabindex="-1" name="from_name" required="" placeholder="Job address or city" style="height: 58px;">
                            </div>
                    <div class="form-group has-feedback">
                    <label for="from_email">Job function</label>
                    <label for="from_email" style="margin-left: 391px;">Seniority level</label>
                    <input class="form-control" type="text" id="from_email" name="from_email" required="" placeholder="" style="height: 58px;width: 335px;">
                    <input class="form-control" type="text" id="from_email" name="from_email" required="" placeholder="Internship, Entry Level......" style="height: 58px;width: 335px;margin-left: 466px;margin-top: -60px;">
                    </div>
                    <div
                        class="form-row">
                        <div class="col-sm-6">
                            <div class="form-group has-feedback">
                            <label for="from_phone">How did you hear about us?</label>
                            <input class="form-control" type="text" id="from_phone" name="subject" placeholder="" style="height: 58px;">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group has-feedback">
                            <label for="from_phone">Employment Type</label>
                            <input class="form-control" type="text" id="from_phone" name="subject" placeholder="Full-time, Part-time...." style="height: 58px;">
                            </div>
                        </div>
                </div>
                <div class="form-group">
                <label for="comments">Describtion</label>
                <textarea class="form-control" id="comments" name="Comments" placeholder="Type uw bericht hier.." rows="5">
                </textarea>
                </div>
                <div class="form-group">
                <button class="btn btn-primary active btn-block" style="background-color: #303641;color: rgb(210,210,210);" type="submit">Create<i class="fa fa-chevron-circle-right" style="color: rgb(227,228,230);">
                </i>
                </button>
                </div>
        </div>
        </div>
        </form>
        </div>
    </section>
@endsection