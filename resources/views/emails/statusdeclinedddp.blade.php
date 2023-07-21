<style>
    .tesstEmail {
        width: 100%;
        padding: 20px;
        text-align: center;
    }

    .tesstEmail h2 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .tesstEmail p {
        font-size: 16px;
        margin-bottom: 10px;
    }

    .tesstEmail table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 10px;
    }

    .tesstEmail th,
    .tesstEmail td {
        border: 1px solid #000000;
        padding: 8px;
    }
</style>

<div class="tesstEmail">
    <h2>Hi {{ $renderbody['HoTen'] }}</h2>
<p>Thank you for considering our services. We sincerely apologize for any inconvenience caused. <strong>We regret to inform you that your booking has been canceled</strong>.</p>
<p>Booking Details:</p>
<p>- Booking ID: {{ $renderbody['MaDDP'] }}</p>
<p>- Total Price: <strong>{{ number_format($renderbody['GiaTien'], 0, ',', '.') }}</strong></p>
<p>- Details:</p>
<div style="display: flex; justify-content: center;">
    <table style="border: 1px solid #000; margin: 0 auto;">
        <thead style="border: 1px solid #000;">
            <tr>
                <th style="border: 1px solid #000; text-align: center;">Room Type</th>
                <th style="border: 1px solid #000; text-align: center;">Number of Nights</th>
                <th style="border: 1px solid #000; text-align: center;">Number of Rooms</th>
                <th style="border: 1px solid #000; text-align: center;">Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($renderbody['ChiTietDonDatPhong'] as $item)
                <tr>
                    <td style="border-left: 1px solid #000; border-right: 1px solid #000; text-align: center;">
                        {{ $item['TenLoaiPhong'] }}</td>
                    <td style="border-left: 1px solid #000; border-right: 1px solid #000; text-align: center;">
                        {{ $item['SoNgayO'] }}</td>
                    <td style="border-left: 1px solid #000; border-right: 1px solid #000; text-align: center;">
                        {{ $item['soLuongPhong'] }}</td>
                    <td style="border-left: 1px solid #000; border-right: 1px solid #000; text-align: center;">
                         {{ number_format($item['Tien'], 0, ',', '.')  }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<p>If you have any further inquiries or need assistance, please feel free to contact us.</p>
</div>
