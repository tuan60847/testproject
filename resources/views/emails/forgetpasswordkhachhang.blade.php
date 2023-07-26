<style>
    .tesstEmail {
        width: 100%;
        padding: 20px;
        text-align: center;
    }
</style>
<div class="tesstEmail">
    <h2>Hi {{ $renderbody['HoTen'] }}</h2>
    <p>Thank you for choosing our services! We sincerely appreciate your trust and support.</p>
    <p>This is Your Password if you click  {{ $renderbody['randomString'] }}  .</p>
    <p>If you need to reset your password, please click <a href="{{ $renderbody['resetPasswordLink'] }}">here</a> to proceed.</p>
</div>   

<form id="resetPasswordForm" action="{{ $renderbody['resetPasswordLink'] }}" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="email" value="{{ $renderbody['Email'] }}">
    <input type="hidden" name="newPassword" value="{{ $renderbody['randomString'] }}">
</form>

<script>
    document.getElementById('resetPasswordLink').addEventListener('click', function(event) {
        event.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết
        document.getElementById('resetPasswordForm').submit(); // Gửi request POST
    });
</script>

