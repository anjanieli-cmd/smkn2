<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Notifikasi Aspirasi E-Voice Baru</title>
</head>
<body style="font-family: 'Helvetica Neue', Arial, sans-serif; background-color: #f4f7fa; margin: 0; padding: 20px; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.08);">
        <div style="background: linear-gradient(135deg, #0d3a66, #1d6fb8); padding: 25px 30px; text-align: center; color: #ffffff;">
            <h2 style="margin: 0; font-size: 22px; font-weight: 800; letter-spacing: 0.5px;">SMK NEGERI 2 MOJOKERTO</h2>
            <p style="margin: 5px 0 0; font-size: 13px; color: #ffd54a; text-transform: uppercase; font-weight: 700;">Notifikasi Admin E-Voice Aspirasi Digital</p>
        </div>
        <div style="padding: 30px;">
            <h3 style="margin-top: 0; color: #0d3a66; font-size: 18px;">Halo Administrator,</h3>
            <p style="font-size: 14px; line-height: 1.6; color: #555;">Telah masuk laporan pengaduan / aspirasi siswa baru melalui portal <strong>E-Voice SKANEDA</strong>. Berikut rincian informasinya:</p>
            
            <table style="width: 100%; border-collapse: collapse; margin: 20px 0; font-size: 14px;">
                <tr>
                    <td style="padding: 10px; border-bottom: 1px solid #eee; font-weight: bold; width: 35%; color: #0d3a66;">Kode Tiket:</td>
                    <td style="padding: 10px; border-bottom: 1px solid #eee; color: #d97706; font-weight: bold;">{{ $eVoice->ticket_code }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border-bottom: 1px solid #eee; font-weight: bold; color: #0d3a66;">Judul Aspirasi:</td>
                    <td style="padding: 10px; border-bottom: 1px solid #eee;">{{ $eVoice->title }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border-bottom: 1px solid #eee; font-weight: bold; color: #0d3a66;">Kategori:</td>
                    <td style="padding: 10px; border-bottom: 1px solid #eee;">{{ is_object($eVoice->category) ? $eVoice->category->value : $eVoice->category }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border-bottom: 1px solid #eee; font-weight: bold; color: #0d3a66;">Waktu Kirim:</td>
                    <td style="padding: 10px; border-bottom: 1px solid #eee;">{{ $eVoice->created_at->translatedFormat('l, d F Y H:i') }} WIB</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border-bottom: 1px solid #eee; font-weight: bold; color: #0d3a66; vertical-align: top;">Isi Pengaduan:</td>
                    <td style="padding: 10px; border-bottom: 1px solid #eee; line-height: 1.6; background: #f8fafc; border-radius: 6px;">{{ $eVoice->description }}</td>
                </tr>
            </table>

            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ url('/admin/e-voices') }}" style="display: inline-block; background: linear-gradient(135deg, #1d6fb8, #0d3a66); color: #ffffff; text-decoration: none; padding: 12px 28px; border-radius: 8px; font-weight: bold; font-size: 14px; box-shadow: 0 4px 12px rgba(29,111,184,0.3);">Buka Panel Admin E-Voice</a>
            </div>
        </div>
        <div style="background: #f8fafc; padding: 15px 30px; text-align: center; font-size: 12px; color: #888; border-top: 1px solid #edf2f7;">
            System Notification &bull; SMK Negeri 2 Mojokerto #DisiplinBerprestasi
        </div>
    </div>
</body>
</html>
