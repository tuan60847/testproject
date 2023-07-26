<!DOCTYPE html>
<html>
<head>
    <title>Thanh toán qua VNPay</title>
    <style>
        /* CSS để căn giữa button */
        body, html {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            padding: 0;
        }

        #vnpayForm {
            /* Thêm margin cho form (tùy chỉnh nếu cần) */
            margin: 20px;
        }

        button {
            /* Tăng kích thước của button (tùy chỉnh nếu cần) */
            font-size: 50px;
        }
    </style>
</head>
<body>
    <form id="vnpayForm" action="{{url($renderbody['PaymentLink']) }}" method="POST">
        @csrf <!-- Thêm mã CSRF token nếu cần -->
        <input type="hidden" name="UIDDatPhong" value="{{ $renderbody['UIDDatPhong'] }}">
        <button type="submit" name="redirect">Thanh toán qua VNPay</button>
    </form>
</body>
