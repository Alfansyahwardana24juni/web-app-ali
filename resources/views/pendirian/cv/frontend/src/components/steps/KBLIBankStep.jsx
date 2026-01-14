import React, { useState } from 'react';
import { Search, Building2, Check, Info } from 'lucide-react';
import { Input } from '../ui/input';
import { Label } from '../ui/label';
import { Card, CardContent } from '../ui/card';
import { Badge } from '../ui/badge';
import { Alert, AlertDescription } from '../ui/alert';
import { cn } from '../../lib/utils';

// Mock KBLI data
const KBLI_DATA = [
  {
    code: '46311',
    name: 'Perdagangan Besar Beras',
    category: 'Perdagangan',
  },
  {
    code: '46499',
    name: 'Perdagangan Besar Barang Lainnya',
    category: 'Perdagangan',
  },
  {
    code: '47911',
    name: 'Perdagangan Eceran Melalui Internet',
    category: 'E-Commerce',
  },
  {
    code: '62010',
    name: 'Aktivitas Pemrograman Komputer',
    category: 'Teknologi',
  },
  {
    code: '62020',
    name: 'Konsultasi Komputer dan Manajemen Fasilitas Komputer',
    category: 'Teknologi',
  },
  {
    code: '70209',
    name: 'Konsultasi Manajemen Lainnya',
    category: 'Konsultasi',
  },
  {
    code: '73100',
    name: 'Periklanan',
    category: 'Kreatif',
  },
  {
    code: '82990',
    name: 'Aktivitas Jasa Penunjang Usaha Lainnya',
    category: 'Jasa',
  },
];

// Mock Indonesian banks with logos
const BANKS = [
  { id: 'bca', name: 'BCA', fullName: 'Bank Central Asia', color: 'bg-blue-600' },
  { id: 'mandiri', name: 'Mandiri', fullName: 'Bank Mandiri', color: 'bg-blue-500' },
  { id: 'bni', name: 'BNI', fullName: 'Bank Negara Indonesia', color: 'bg-orange-500' },
  { id: 'bri', name: 'BRI', fullName: 'Bank Rakyat Indonesia', color: 'bg-blue-700' },
  { id: 'cimb', name: 'CIMB Niaga', fullName: 'CIMB Niaga', color: 'bg-red-600' },
  { id: 'permata', name: 'Permata', fullName: 'Bank Permata', color: 'bg-green-600' },
];

export default function KBLIBankStep({ data, onChange }) {
  const [searchQuery, setSearchQuery] = useState('');
  const [showResults, setShowResults] = useState(false);

  const handleChange = (field, value) => {
    onChange({ ...data, [field]: value });
  };

  const filteredKBLI = KBLI_DATA.filter(
    (kbli) =>
      kbli.name.toLowerCase().includes(searchQuery.toLowerCase()) ||
      kbli.code.includes(searchQuery) ||
      kbli.category.toLowerCase().includes(searchQuery.toLowerCase())
  );

  const selectedKBLI = KBLI_DATA.find((k) => k.code === data.kbli);

  return (
    <div className="space-y-6">
      <Alert className="bg-accent/10 border-accent/20">
        <Info className="h-4 w-4 text-accent" />
        <AlertDescription className="text-sm text-foreground">
          KBLI (Klasifikasi Baku Lapangan Usaha Indonesia) adalah kode yang
          menggambarkan bidang usaha perusahaan Anda.
        </AlertDescription>
      </Alert>

      {/* KBLI Selection */}
      <div className="space-y-2">
        <Label htmlFor="kbli" className="text-sm font-medium">
          Pilih KBLI <span className="text-destructive">*</span>
        </Label>

        {/* Search Box */}
        <div className="relative">
          <Search className="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-muted-foreground" />
          <Input
            id="kbli"
            placeholder="Cari KBLI berdasarkan nama atau kode..."
            value={searchQuery}
            onChange={(e) => {
              setSearchQuery(e.target.value);
              setShowResults(true);
            }}
            onFocus={() => setShowResults(true)}
            className="input-touch pl-10"
          />
        </div>

        {/* Selected KBLI */}
        {selectedKBLI && !showResults && (
          <Card className="border-2 border-success bg-success-light">
            <CardContent className="p-4">
              <div className="flex items-start gap-3">
                <Check className="w-5 h-5 text-success flex-shrink-0 mt-0.5" />
                <div className="flex-1">
                  <div className="flex items-center gap-2 mb-1">
                    <span className="text-sm font-semibold text-foreground">
                      {selectedKBLI.code}
                    </span>
                    <Badge variant="secondary" className="text-xs">
                      {selectedKBLI.category}
                    </Badge>
                  </div>
                  <p className="text-sm text-foreground">
                    {selectedKBLI.name}
                  </p>
                  <button
                    onClick={() => {
                      setShowResults(true);
                      setSearchQuery('');
                    }}
                    className="text-xs text-accent hover:underline mt-2"
                  >
                    Ganti KBLI
                  </button>
                </div>
              </div>
            </CardContent>
          </Card>
        )}

        {/* Search Results */}
        {showResults && searchQuery && (
          <Card className="max-h-80 overflow-y-auto">
            <CardContent className="p-2">
              {filteredKBLI.length > 0 ? (
                <div className="space-y-1">
                  {filteredKBLI.map((kbli) => (
                    <button
                      key={kbli.code}
                      onClick={() => {
                        handleChange('kbli', kbli.code);
                        setShowResults(false);
                        setSearchQuery('');
                      }}
                      className="w-full text-left p-3 rounded-lg hover:bg-muted transition-colors"
                    >
                      <div className="flex items-center gap-2 mb-1">
                        <span className="text-sm font-semibold text-foreground">
                          {kbli.code}
                        </span>
                        <Badge variant="secondary" className="text-xs">
                          {kbli.category}
                        </Badge>
                      </div>
                      <p className="text-sm text-muted-foreground">
                        {kbli.name}
                      </p>
                    </button>
                  ))}
                </div>
              ) : (
                <div className="p-4 text-center text-sm text-muted-foreground">
                  Tidak ada hasil untuk "{searchQuery}"
                </div>
              )}
            </CardContent>
          </Card>
        )}
      </div>

      {/* Bank Selection */}
      <div className="space-y-3">
        <Label className="text-sm font-medium">
          Bank Rekanan <span className="text-destructive">*</span>
        </Label>
        <p className="text-xs text-muted-foreground -mt-1">
          Pilih bank untuk rekening perusahaan Anda
        </p>

        <div className="grid grid-cols-2 gap-3">
          {BANKS.map((bank) => (
            <button
              key={bank.id}
              onClick={() => handleChange('bank', bank.id)}
              className={cn(
                'relative p-4 rounded-lg border-2 transition-all text-left',
                data.bank === bank.id
                  ? 'border-primary bg-primary/5 shadow-md'
                  : 'border-border hover:border-primary/50 hover:bg-muted/50'
              )}
            >
              {data.bank === bank.id && (
                <div className="absolute top-2 right-2">
                  <div className="w-6 h-6 rounded-full bg-primary flex items-center justify-center">
                    <Check className="w-4 h-4 text-primary-foreground" />
                  </div>
                </div>
              )}
              <div className="flex items-center gap-3">
                <div
                  className={cn(
                    'w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0',
                    bank.color
                  )}
                >
                  <Building2 className="w-5 h-5 text-white" />
                </div>
                <div className="flex-1 min-w-0">
                  <p className="text-sm font-semibold text-foreground">
                    {bank.name}
                  </p>
                  <p className="text-xs text-muted-foreground truncate">
                    {bank.fullName}
                  </p>
                </div>
              </div>
            </button>
          ))}
        </div>
      </div>
    </div>
  );
}