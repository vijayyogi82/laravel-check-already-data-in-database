
Route::get('contact_search', [InfluencerController::class, 'contact_search'])->name('influencer.contact_search');
<!-- ---------------------- -->

<style>
  .contact_err {
  animation: colorfulAnimation 2s infinite;
}
@keyframes colorfulAnimation {
  0% { color: red; }
  25% { color: blue; }
  50% { color: green; }
  75% { color: gray; }
  100% { color: purple; }
}
</style>
<!-- ---------------------- -->

<!-- also type text and 10 digit limit -->
<div class="mt-4">
  <label for="CONTACT" class="form-label">CONTACT</label>
  <input type="text" class="form-control" id="CONTACT" name="contact" tabindex="3" required
      oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10)">
   <span class="contact_err"></span>
</div>

<!-- ---------------------- -->
<script>
    $(document).on('change', '#CONTACT', function() {
        var contact = $("#CONTACT").val();
        console.log(contact);
        var url = "{{Route('influencer.contact_search')}}";
        $.ajax({
            url: url,
            method: "GET",
            data: {
                'contact': contact
            },
            success: function(result) {
                if (result == 1) {
                    $(".contact_err").html('This contact Is Already Exist');
                    $(".contact_err").addClass('contact_err_animated');
                } else {
                    $(".contact_err").html('');
                    $(".contact_err").removeClass('contact_err_animated');
                }
            }
        });
    });
</script>
<!-- ---------------------- -->

public function contact_search(Request $request){
  $contact = User::where('contact',$request->contact)->first();
  if($contact){
     $html =  true;
  }
  else{
      $html = '0';
  }
  echo $html;
}


