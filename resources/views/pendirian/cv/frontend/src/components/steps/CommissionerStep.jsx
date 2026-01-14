import React from 'react';
import { Plus, Trash2, Upload, X, Check } from 'lucide-react';
import { Button } from '../ui/button';
import { Input } from '../ui/input';
import { Label } from '../ui/label';
import { Card, CardContent } from '../ui/card';
import { Badge } from '../ui/badge';
import { Alert, AlertDescription } from '../ui/alert';

export default function CommissionerStep({ commissioners, onChange }) {
  const handleAddCommissioner = () => {
    onChange([
      ...commissioners,
      { id: Date.now(), name: '', ktp: null, npwp: null },
    ]);
  };

  const handleRemoveCommissioner = (id) => {
    if (commissioners.length > 1) {
      onChange(commissioners.filter((c) => c.id !== id));
    }
  };

  const handleCommissionerChange = (id, field, value) => {
    onChange(
      commissioners.map((c) => (c.id === id ? { ...c, [field]: value } : c))
    );
  };

  const handleFileUpload = (id, field, file) => {
    if (file) {
      const reader = new FileReader();
      reader.onloadend = () => {
        handleCommissionerChange(id, field, {
          name: file.name,
          size: file.size,
          type: file.type,
          preview: reader.result,
        });
      };
      reader.readAsDataURL(file);
    }
  };

  const handleRemoveFile = (id, field) => {
    handleCommissionerChange(id, field, null);
  };

  return (
    <div className="space-y-6">
      <Alert className="bg-accent/10 border-accent/20">
        <AlertDescription className="text-sm text-foreground">
          Minimal 1 komisaris diperlukan. Anda dapat menambahkan lebih dari satu
          komisaris jika diperlukan.
        </AlertDescription>
      </Alert>

      {commissioners.map((commissioner, index) => (
        <Card key={commissioner.id} className="border-2 border-border animate-slide-in">
          <CardContent className="p-4 md:p-6">
            <div className="flex items-center justify-between mb-4">
              <div className="flex items-center gap-2">
                <Badge variant="secondary" className="font-medium">
                  Komisaris {index + 1}
                </Badge>
              </div>
              {commissioners.length > 1 && (
                <Button
                  variant="ghost"
                  size="sm"
                  onClick={() => handleRemoveCommissioner(commissioner.id)}
                  className="text-destructive hover:text-destructive hover:bg-destructive/10"
                >
                  <Trash2 className="w-4 h-4" />
                </Button>
              )}
            </div>

            <div className="space-y-4">
              {/* Name */}
              <div className="space-y-2">
                <Label htmlFor={`commissioner-name-${commissioner.id}`}>
                  Nama Lengkap <span className="text-destructive">*</span>
                </Label>
                <Input
                  id={`commissioner-name-${commissioner.id}`}
                  placeholder="Nama lengkap sesuai KTP"
                  value={commissioner.name}
                  onChange={(e) =>
                    handleCommissionerChange(commissioner.id, 'name', e.target.value)
                  }
                  className="input-touch"
                />
              </div>

              {/* KTP Upload */}
              <div className="space-y-2">
                <Label htmlFor={`commissioner-ktp-${commissioner.id}`}>
                  Upload KTP <span className="text-destructive">*</span>
                </Label>
                {!commissioner.ktp ? (
                  <div className="relative">
                    <input
                      type="file"
                      id={`commissioner-ktp-${commissioner.id}`}
                      accept="image/*,.pdf"
                      onChange={(e) =>
                        handleFileUpload(commissioner.id, 'ktp', e.target.files[0])
                      }
                      className="hidden"
                    />
                    <label htmlFor={`commissioner-ktp-${commissioner.id}`}>
                      <div className="border-2 border-dashed border-border rounded-lg p-6 cursor-pointer hover:bg-muted/50 transition-colors text-center">
                        <Upload className="w-8 h-8 mx-auto mb-2 text-muted-foreground" />
                        <p className="text-sm font-medium text-foreground">
                          Pilih atau seret file
                        </p>
                        <p className="text-xs text-muted-foreground mt-1">
                          JPG, PNG atau PDF (max 5MB)
                        </p>
                      </div>
                    </label>
                  </div>
                ) : (
                  <div className="flex items-center gap-2 p-3 bg-success-light border border-success/20 rounded-lg">
                    <Check className="w-5 h-5 text-success flex-shrink-0" />
                    <div className="flex-1 min-w-0">
                      <p className="text-sm font-medium text-foreground truncate">
                        {commissioner.ktp.name}
                      </p>
                      <p className="text-xs text-muted-foreground">
                        {(commissioner.ktp.size / 1024).toFixed(1)} KB
                      </p>
                    </div>
                    <Button
                      variant="ghost"
                      size="sm"
                      onClick={() => handleRemoveFile(commissioner.id, 'ktp')}
                      className="flex-shrink-0"
                    >
                      <X className="w-4 h-4" />
                    </Button>
                  </div>
                )}
              </div>

              {/* NPWP Upload (Optional) */}
              <div className="space-y-2">
                <Label htmlFor={`commissioner-npwp-${commissioner.id}`}>
                  Upload NPWP{' '}
                  <span className="text-muted-foreground text-xs">(Opsional)</span>
                </Label>
                {!commissioner.npwp ? (
                  <div className="relative">
                    <input
                      type="file"
                      id={`commissioner-npwp-${commissioner.id}`}
                      accept="image/*,.pdf"
                      onChange={(e) =>
                        handleFileUpload(commissioner.id, 'npwp', e.target.files[0])
                      }
                      className="hidden"
                    />
                    <label htmlFor={`commissioner-npwp-${commissioner.id}`}>
                      <div className="border-2 border-dashed border-border rounded-lg p-4 cursor-pointer hover:bg-muted/50 transition-colors text-center">
                        <Upload className="w-6 h-6 mx-auto mb-1 text-muted-foreground" />
                        <p className="text-xs text-muted-foreground">
                          JPG, PNG atau PDF (max 5MB)
                        </p>
                      </div>
                    </label>
                  </div>
                ) : (
                  <div className="flex items-center gap-2 p-3 bg-success-light border border-success/20 rounded-lg">
                    <Check className="w-5 h-5 text-success flex-shrink-0" />
                    <div className="flex-1 min-w-0">
                      <p className="text-sm font-medium text-foreground truncate">
                        {commissioner.npwp.name}
                      </p>
                      <p className="text-xs text-muted-foreground">
                        {(commissioner.npwp.size / 1024).toFixed(1)} KB
                      </p>
                    </div>
                    <Button
                      variant="ghost"
                      size="sm"
                      onClick={() => handleRemoveFile(commissioner.id, 'npwp')}
                      className="flex-shrink-0"
                    >
                      <X className="w-4 h-4" />
                    </Button>
                  </div>
                )}
              </div>
            </div>
          </CardContent>
        </Card>
      ))}

      <Button
        onClick={handleAddCommissioner}
        variant="outline"
        className="w-full btn-touch border-2 border-dashed border-primary text-primary hover:bg-primary/5"
      >
        <Plus className="w-4 h-4 mr-2" />
        Tambah Komisaris
      </Button>
    </div>
  );
}