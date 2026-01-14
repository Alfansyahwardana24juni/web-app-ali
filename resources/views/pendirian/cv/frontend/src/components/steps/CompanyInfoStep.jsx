import React, { useState } from 'react';
import { MapPin, Info } from 'lucide-react';
import { Input } from '../ui/input';
import { Label } from '../ui/label';
import { Textarea } from '../ui/textarea';
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '../ui/select';
import { Card, CardContent } from '../ui/card';
import { Alert, AlertDescription } from '../ui/alert';

// Mock Indonesian provinces and cities
const PROVINCES = [
  { id: '1', name: 'DKI Jakarta' },
  { id: '2', name: 'Jawa Barat' },
  { id: '3', name: 'Jawa Tengah' },
  { id: '4', name: 'Jawa Timur' },
  { id: '5', name: 'Bali' },
  { id: '6', name: 'Sumatera Utara' },
  { id: '7', name: 'Sulawesi Selatan' },
];

const CITIES = {
  '1': ['Jakarta Pusat', 'Jakarta Selatan', 'Jakarta Barat', 'Jakarta Utara', 'Jakarta Timur'],
  '2': ['Bandung', 'Bekasi', 'Bogor', 'Depok', 'Cirebon'],
  '3': ['Semarang', 'Solo', 'Magelang', 'Purwokerto', 'Tegal'],
  '4': ['Surabaya', 'Malang', 'Sidoarjo', 'Gresik', 'Kediri'],
  '5': ['Denpasar', 'Badung', 'Gianyar', 'Tabanan', 'Klungkung'],
  '6': ['Medan', 'Deli Serdang', 'Binjai', 'Tebing Tinggi', 'Pematang Siantar'],
  '7': ['Makassar', 'Gowa', 'Maros', 'Bone', 'Bulukumba'],
};

const DISTRICTS = {
  'Jakarta Pusat': ['Menteng', 'Tanah Abang', 'Gambir', 'Sawah Besar', 'Kemayoran'],
  'Bandung': ['Coblong', 'Cidadap', 'Sukasari', 'Cibeunying Kaler', 'Sukajadi'],
  'Surabaya': ['Gubeng', 'Tegalsari', 'Genteng', 'Rungkut', 'Wonokromo'],
  'default': ['Kecamatan 1', 'Kecamatan 2', 'Kecamatan 3'],
};

const VILLAGES = {
  'Menteng': ['Menteng', 'Pegangsaan', 'Cikini', 'Kebon Sirih'],
  'Coblong': ['Dago', 'Lebak Siliwangi', 'Sadang Serang', 'Cipaganti'],
  'Gubeng': ['Gubeng', 'Airlangga', 'Mojo', 'Pucang Sewu'],
  'default': ['Kelurahan 1', 'Kelurahan 2', 'Kelurahan 3'],
};

export default function CompanyInfoStep({ data, onChange }) {
  const [selectedProvince, setSelectedProvince] = useState(data.province || '');
  const [selectedCity, setSelectedCity] = useState(data.city || '');
  const [selectedDistrict, setSelectedDistrict] = useState(data.district || '');

  const handleChange = (field, value) => {
    onChange({ ...data, [field]: value });
  };

  const handleProvinceChange = (value) => {
    setSelectedProvince(value);
    setSelectedCity('');
    setSelectedDistrict('');
    onChange({
      ...data,
      province: value,
      city: '',
      district: '',
      village: '',
    });
  };

  const handleCityChange = (value) => {
    setSelectedCity(value);
    setSelectedDistrict('');
    onChange({ ...data, city: value, district: '', village: '' });
  };

  const handleDistrictChange = (value) => {
    setSelectedDistrict(value);
    onChange({ ...data, district: value, village: '' });
  };

  const availableCities = selectedProvince ? CITIES[selectedProvince] || [] : [];
  const availableDistricts = selectedCity
    ? DISTRICTS[selectedCity] || DISTRICTS['default']
    : [];
  const availableVillages = selectedDistrict
    ? VILLAGES[selectedDistrict] || VILLAGES['default']
    : [];

  return (
    <div className="space-y-6">
      <Alert className="bg-accent/10 border-accent/20">
        <Info className="h-4 w-4 text-accent" />
        <AlertDescription className="text-sm text-foreground">
          Pastikan semua informasi yang Anda masukkan sesuai dengan dokumen
          resmi perusahaan.
        </AlertDescription>
      </Alert>

      {/* Company Name */}
      <div className="space-y-2">
        <Label htmlFor="companyName" className="text-sm font-medium">
          Nama Perusahaan <span className="text-destructive">*</span>
        </Label>
        <Input
          id="companyName"
          placeholder="PT Contoh Perusahaan"
          value={data.companyName || ''}
          onChange={(e) => handleChange('companyName', e.target.value)}
          className="input-touch"
        />
        <p className="text-xs text-muted-foreground">
          Nama lengkap perusahaan yang akan didaftarkan
        </p>
      </div>

      {/* Address Section */}
      <Card className="bg-muted/50 border-border">
        <CardContent className="p-4 space-y-4">
          <div className="flex items-center gap-2 mb-2">
            <MapPin className="w-4 h-4 text-primary" />
            <h3 className="text-sm font-semibold text-foreground">
              Alamat Perusahaan
            </h3>
          </div>

          {/* Province */}
          <div className="space-y-2">
            <Label htmlFor="province" className="text-sm font-medium">
              Provinsi <span className="text-destructive">*</span>
            </Label>
            <Select value={selectedProvince} onValueChange={handleProvinceChange}>
              <SelectTrigger id="province" className="input-touch">
                <SelectValue placeholder="Pilih Provinsi" />
              </SelectTrigger>
              <SelectContent>
                {PROVINCES.map((prov) => (
                  <SelectItem key={prov.id} value={prov.id}>
                    {prov.name}
                  </SelectItem>
                ))}
              </SelectContent>
            </Select>
          </div>

          {/* City */}
          <div className="space-y-2">
            <Label htmlFor="city" className="text-sm font-medium">
              Kota/Kabupaten <span className="text-destructive">*</span>
            </Label>
            <Select
              value={selectedCity}
              onValueChange={handleCityChange}
              disabled={!selectedProvince}
            >
              <SelectTrigger id="city" className="input-touch">
                <SelectValue placeholder="Pilih Kota/Kabupaten" />
              </SelectTrigger>
              <SelectContent>
                {availableCities.map((city) => (
                  <SelectItem key={city} value={city}>
                    {city}
                  </SelectItem>
                ))}
              </SelectContent>
            </Select>
          </div>

          {/* District */}
          <div className="space-y-2">
            <Label htmlFor="district" className="text-sm font-medium">
              Kecamatan <span className="text-destructive">*</span>
            </Label>
            <Select
              value={selectedDistrict}
              onValueChange={handleDistrictChange}
              disabled={!selectedCity}
            >
              <SelectTrigger id="district" className="input-touch">
                <SelectValue placeholder="Pilih Kecamatan" />
              </SelectTrigger>
              <SelectContent>
                {availableDistricts.map((district) => (
                  <SelectItem key={district} value={district}>
                    {district}
                  </SelectItem>
                ))}
              </SelectContent>
            </Select>
          </div>

          {/* Village */}
          <div className="space-y-2">
            <Label htmlFor="village" className="text-sm font-medium">
              Desa/Kelurahan <span className="text-destructive">*</span>
            </Label>
            <Select
              value={data.village || ''}
              onValueChange={(value) => handleChange('village', value)}
              disabled={!selectedDistrict}
            >
              <SelectTrigger id="village" className="input-touch">
                <SelectValue placeholder="Pilih Desa/Kelurahan" />
              </SelectTrigger>
              <SelectContent>
                {availableVillages.map((village) => (
                  <SelectItem key={village} value={village}>
                    {village}
                  </SelectItem>
                ))}
              </SelectContent>
            </Select>
          </div>
        </CardContent>
      </Card>

      {/* Full Address */}
      <div className="space-y-2">
        <Label htmlFor="fullAddress" className="text-sm font-medium">
          Alamat Lengkap <span className="text-destructive">*</span>
        </Label>
        <Textarea
          id="fullAddress"
          placeholder="Jl. Contoh No. 123, RT 01/RW 02"
          value={data.fullAddress || ''}
          onChange={(e) => handleChange('fullAddress', e.target.value)}
          rows={3}
          className="resize-none"
        />
        <p className="text-xs text-muted-foreground">
          Nama jalan, nomor, RT/RW, dan detail lainnya
        </p>
      </div>

      {/* Postal Code */}
      <div className="space-y-2">
        <Label htmlFor="postalCode" className="text-sm font-medium">
          Kode Pos <span className="text-destructive">*</span>
        </Label>
        <Input
          id="postalCode"
          type="text"
          placeholder="12345"
          value={data.postalCode || ''}
          onChange={(e) => handleChange('postalCode', e.target.value)}
          maxLength={5}
          className="input-touch"
        />
      </div>
    </div>
  );
}