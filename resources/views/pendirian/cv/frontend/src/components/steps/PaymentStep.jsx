import React from 'react';
import { Upload, X, Check, FileText, User, MapPin, Landmark, CreditCard, Info } from 'lucide-react';
import { Button } from '../ui/button';
import { Label } from '../ui/label';
import { Card, CardContent, CardHeader, CardTitle } from '../ui/card';
import { Separator } from '../ui/separator';
import { Alert, AlertDescription } from '../ui/alert';
import { Badge } from '../ui/badge';

export default function PaymentStep({ data, onChange, formData }) {
  const handleFileUpload = (file) => {
    if (file) {
      const reader = new FileReader();
      reader.onloadend = () => {
        onChange({
          ...data,
          paymentProof: {
            name: file.name,
            size: file.size,
            type: file.type,
            preview: reader.result,
          },
        });
      };
      reader.readAsDataURL(file);
    }
  };

  const handleRemoveFile = () => {
    onChange({ ...data, paymentProof: null });
  };

  // Calculate costs (mock data)
  const baseFee = 5000000;
  const adminFee = 500000;
  const total = baseFee + adminFee;

  return (
    <div className="space-y-6">
      {/* Application Summary */}
      <Card className="bg-muted/50 border-border">
        <CardHeader className="pb-3">
          <CardTitle className="text-base font-semibold flex items-center gap-2">
            <FileText className="w-4 h-4 text-primary" />
            Ringkasan Permohonan
          </CardTitle>
        </CardHeader>
        <CardContent className="space-y-3 text-sm">
          {/* Company Info */}
          <div className="flex gap-3">
            <div className="text-muted-foreground w-24 flex-shrink-0">
              Perusahaan:
            </div>
            <div className="font-medium text-foreground">
              {formData.companyInfo?.companyName || '-'}
            </div>
          </div>

          {/* Address */}
          <div className="flex gap-3">
            <div className="text-muted-foreground w-24 flex-shrink-0">
              Lokasi:
            </div>
            <div className="font-medium text-foreground">
              {formData.companyInfo?.city || '-'},{' '}
              {formData.companyInfo?.province || '-'}
            </div>
          </div>

          {/* Directors */}
          <div className="flex gap-3">
            <div className="text-muted-foreground w-24 flex-shrink-0">
              Direktur:
            </div>
            <div className="font-medium text-foreground">
              {formData.directors?.filter((d) => d.name).length || 0} orang
            </div>
          </div>

          {/* Commissioners */}
          <div className="flex gap-3">
            <div className="text-muted-foreground w-24 flex-shrink-0">
              Komisaris:
            </div>
            <div className="font-medium text-foreground">
              {formData.commissioners?.filter((c) => c.name).length || 0} orang
            </div>
          </div>

          {/* KBLI */}
          <div className="flex gap-3">
            <div className="text-muted-foreground w-24 flex-shrink-0">KBLI:</div>
            <div className="font-medium text-foreground">
              {formData.kbliBank?.kbli || '-'}
            </div>
          </div>
        </CardContent>
      </Card>

      {/* Payment Details */}
      <Card className="border-2 border-primary/20">
        <CardHeader className="pb-3">
          <CardTitle className="text-base font-semibold flex items-center gap-2">
            <CreditCard className="w-4 h-4 text-primary" />
            Rincian Pembayaran
          </CardTitle>
        </CardHeader>
        <CardContent className="space-y-3">
          <div className="space-y-2">
            <div className="flex justify-between text-sm">
              <span className="text-muted-foreground">Biaya Pengurusan CV</span>
              <span className="font-medium text-foreground">
                Rp {baseFee.toLocaleString('id-ID')}
              </span>
            </div>
            <div className="flex justify-between text-sm">
              <span className="text-muted-foreground">Biaya Admin</span>
              <span className="font-medium text-foreground">
                Rp {adminFee.toLocaleString('id-ID')}
              </span>
            </div>
          </div>

          <Separator />

          <div className="flex justify-between items-center">
            <span className="text-base font-semibold text-foreground">
              Total Pembayaran
            </span>
            <span className="text-lg font-bold text-primary">
              Rp {total.toLocaleString('id-ID')}
            </span>
          </div>
        </CardContent>
      </Card>

      {/* Payment Instructions */}
      <Alert>
        <Info className="h-4 w-4" />
        <AlertDescription className="text-sm space-y-2">
          <p className="font-medium">Instruksi Pembayaran:</p>
          <ol className="list-decimal list-inside space-y-1 text-muted-foreground">
            <li>Transfer ke rekening BCA: 1234567890</li>
            <li>Atas nama: PT Layanan CV Indonesia</li>
            <li>Gunakan nominal yang tepat untuk verifikasi otomatis</li>
            <li>Simpan bukti transfer</li>
            <li>Upload bukti transfer di bawah ini</li>
          </ol>
        </AlertDescription>
      </Alert>

      {/* Upload Payment Proof */}
      <div className="space-y-2">
        <Label htmlFor="paymentProof" className="text-sm font-medium">
          Upload Bukti Pembayaran <span className="text-destructive">*</span>
        </Label>
        {!data.paymentProof ? (
          <div className="relative">
            <input
              type="file"
              id="paymentProof"
              accept="image/*,.pdf"
              onChange={(e) => handleFileUpload(e.target.files[0])}
              className="hidden"
            />
            <label htmlFor="paymentProof">
              <div className="border-2 border-dashed border-border rounded-lg p-8 cursor-pointer hover:bg-muted/50 transition-colors text-center">
                <Upload className="w-10 h-10 mx-auto mb-3 text-muted-foreground" />
                <p className="text-sm font-medium text-foreground mb-1">
                  Pilih atau seret file bukti transfer
                </p>
                <p className="text-xs text-muted-foreground">
                  JPG, PNG atau PDF (max 5MB)
                </p>
              </div>
            </label>
          </div>
        ) : (
          <Card className="border-2 border-success bg-success-light">
            <CardContent className="p-4">
              <div className="flex items-center gap-3">
                <Check className="w-6 h-6 text-success flex-shrink-0" />
                <div className="flex-1 min-w-0">
                  <p className="text-sm font-semibold text-foreground truncate">
                    {data.paymentProof.name}
                  </p>
                  <p className="text-xs text-muted-foreground">
                    {(data.paymentProof.size / 1024).toFixed(1)} KB
                  </p>
                </div>
                <Button
                  variant="ghost"
                  size="sm"
                  onClick={handleRemoveFile}
                  className="flex-shrink-0"
                >
                  <X className="w-4 h-4" />
                </Button>
              </div>
            </CardContent>
          </Card>
        )}
        <p className="text-xs text-muted-foreground">
          Pastikan bukti transfer menunjukkan tanggal, nominal, dan nama penerima
          dengan jelas
        </p>
      </div>

      {/* Success Message */}
      {data.paymentProof && (
        <Alert className="bg-success-light border-success/20">
          <Check className="h-4 w-4 text-success" />
          <AlertDescription className="text-sm text-foreground">
            <p className="font-medium mb-1">Bukti pembayaran berhasil diupload!</p>
            <p className="text-muted-foreground">
              Klik "Kirim Permohonan" untuk menyelesaikan proses. Tim kami akan
              memverifikasi pembayaran dalam 1-2 hari kerja.
            </p>
          </AlertDescription>
        </Alert>
      )}
    </div>
  );
}