import React from 'react';
import { Plus, Trash2, Upload, X, Check } from 'lucide-react';
import { Button } from '../ui/button';
import { Input } from '../ui/input';
import { Label } from '../ui/label';
import { Card, CardContent } from '../ui/card';
import { Badge } from '../ui/badge';
import { Alert, AlertDescription } from '../ui/alert';

export default function DirectorStep({ directors, onChange }) {
  const handleAddDirector = () => {
    onChange([
      ...directors,
      { id: Date.now(), name: '', ktp: null, npwp: null },
    ]);
  };

  const handleRemoveDirector = (id) => {
    if (directors.length > 1) {
      onChange(directors.filter((d) => d.id !== id));
    }
  };

  const handleDirectorChange = (id, field, value) => {
    onChange(
      directors.map((d) => (d.id === id ? { ...d, [field]: value } : d))
    );
  };

  const handleFileUpload = (id, field, file) => {
    if (file) {
      // In a real app, you'd upload to a server
      // For now, store file reference
      const reader = new FileReader();
      reader.onloadend = () => {
        handleDirectorChange(id, field, {
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
    handleDirectorChange(id, field, null);
  };

  return (
    <div className="space-y-6">
      <Alert className="bg-accent/10 border-accent/20">
        <AlertDescription className="text-sm text-foreground">
          Minimal 1 direktur diperlukan. Anda dapat menambahkan lebih dari satu
          direktur jika diperlukan.
        </AlertDescription>
      </Alert>

      {directors.map((director, index) => (
        <Card key={director.id} className="border-2 border-border animate-slide-in">
          <CardContent className="p-4 md:p-6">
            <div className="flex items-center justify-between mb-4">
              <div className="flex items-center gap-2">
                <Badge variant="secondary" className="font-medium">
                  Direktur {index + 1}
                </Badge>
              </div>
              {directors.length > 1 && (
                <Button
                  variant="ghost"
                  size="sm"
                  onClick={() => handleRemoveDirector(director.id)}
                  className="text-destructive hover:text-destructive hover:bg-destructive/10"
                >
                  <Trash2 className="w-4 h-4" />
                </Button>
              )}
            </div>

            <div className="space-y-4">
              {/* Name */}
              <div className="space-y-2">
                <Label htmlFor={`director-name-${director.id}`}>
                  Nama Lengkap <span className="text-destructive">*</span>
                </Label>
                <Input
                  id={`director-name-${director.id}`}
                  placeholder="Nama lengkap sesuai KTP"
                  value={director.name}
                  onChange={(e) =>
                    handleDirectorChange(director.id, 'name', e.target.value)
                  }
                  className="input-touch"
                />
              </div>

              {/* KTP Upload */}
              <div className="space-y-2">
                <Label htmlFor={`director-ktp-${director.id}`}>
                  Upload KTP <span className="text-destructive">*</span>
                </Label>
                {!director.ktp ? (
                  <div className="relative">
                    <input
                      type="file"
                      id={`director-ktp-${director.id}`}
                      accept="image/*,.pdf"
                      onChange={(e) =>
                        handleFileUpload(director.id, 'ktp', e.target.files[0])
                      }
                      className="hidden"
                    />
                    <label htmlFor={`director-ktp-${director.id}`}>
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
                        {director.ktp.name}
                      </p>
                      <p className="text-xs text-muted-foreground">
                        {(director.ktp.size / 1024).toFixed(1)} KB
                      </p>
                    </div>
                    <Button
                      variant="ghost"
                      size="sm"
                      onClick={() => handleRemoveFile(director.id, 'ktp')}
                      className="flex-shrink-0"
                    >
                      <X className="w-4 h-4" />
                    </Button>
                  </div>
                )}
              </div>

              {/* NPWP Upload (Optional) */}
              <div className="space-y-2">
                <Label htmlFor={`director-npwp-${director.id}`}>
                  Upload NPWP{' '}
                  <span className="text-muted-foreground text-xs">(Opsional)</span>
                </Label>
                {!director.npwp ? (
                  <div className="relative">
                    <input
                      type="file"
                      id={`director-npwp-${director.id}`}
                      accept="image/*,.pdf"
                      onChange={(e) =>
                        handleFileUpload(director.id, 'npwp', e.target.files[0])
                      }
                      className="hidden"
                    />
                    <label htmlFor={`director-npwp-${director.id}`}>
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
                        {director.npwp.name}
                      </p>
                      <p className="text-xs text-muted-foreground">
                        {(director.npwp.size / 1024).toFixed(1)} KB
                      </p>
                    </div>
                    <Button
                      variant="ghost"
                      size="sm"
                      onClick={() => handleRemoveFile(director.id, 'npwp')}
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
        onClick={handleAddDirector}
        variant="outline"
        className="w-full btn-touch border-2 border-dashed border-primary text-primary hover:bg-primary/5"
      >
        <Plus className="w-4 h-4 mr-2" />
        Tambah Direktur
      </Button>
    </div>
  );
}