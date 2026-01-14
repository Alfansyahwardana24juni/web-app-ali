import React, { useState, useEffect } from 'react';
import { CheckCircle2, Building2, Users, UserCog, Landmark, CreditCard, Save, ChevronLeft } from 'lucide-react';
import { toast } from 'sonner';
import ProgressStepper from './ProgressStepper';
import CompanyInfoStep from './steps/CompanyInfoStep';
import DirectorStep from './steps/DirectorStep';
import CommissionerStep from './steps/CommissionerStep';
import KBLIBankStep from './steps/KBLIBankStep';
import PaymentStep from './steps/PaymentStep';
import { Button } from './ui/button';
import { Card, CardContent } from './ui/card';

const STEPS = [
  { id: 1, title: 'Informasi Perusahaan', icon: Building2, shortTitle: 'Perusahaan' },
  { id: 2, title: 'Direktur', icon: Users, shortTitle: 'Direktur' },
  { id: 3, title: 'Komisaris', icon: UserCog, shortTitle: 'Komisaris' },
  { id: 4, title: 'KBLI & Bank', icon: Landmark, shortTitle: 'KBLI' },
  { id: 5, title: 'Pembayaran', icon: CreditCard, shortTitle: 'Bayar' },
];

const STORAGE_KEY = 'cv_form_data';

export default function FormWizard() {
  const [currentStep, setCurrentStep] = useState(1);
  const [formData, setFormData] = useState({
    companyInfo: {},
    directors: [{ id: Date.now(), name: '', ktp: null, npwp: null }],
    commissioners: [{ id: Date.now(), name: '', ktp: null, npwp: null }],
    kbliBank: {},
    payment: {},
  });
  const [lastSaved, setLastSaved] = useState(null);

  // Load saved data on mount
  useEffect(() => {
    const saved = localStorage.getItem(STORAGE_KEY);
    if (saved) {
      try {
        const parsed = JSON.parse(saved);
        setFormData(parsed.formData);
        setCurrentStep(parsed.currentStep || 1);
        toast.success('Data tersimpan berhasil dimuat');
      } catch (e) {
        console.error('Error loading saved data:', e);
      }
    }
  }, []);

  // Auto-save functionality
  useEffect(() => {
    const timer = setTimeout(() => {
      localStorage.setItem(
        STORAGE_KEY,
        JSON.stringify({ formData, currentStep })
      );
      setLastSaved(new Date());
    }, 1000);

    return () => clearTimeout(timer);
  }, [formData, currentStep]);

  const updateFormData = (section, data) => {
    setFormData((prev) => ({
      ...prev,
      [section]: data,
    }));
  };

  const handleNext = () => {
    if (validateCurrentStep()) {
      if (currentStep < STEPS.length) {
        setCurrentStep((prev) => prev + 1);
        window.scrollTo({ top: 0, behavior: 'smooth' });
      } else {
        handleSubmit();
      }
    }
  };

  const handleBack = () => {
    if (currentStep > 1) {
      setCurrentStep((prev) => prev - 1);
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }
  };

  const validateCurrentStep = () => {
    switch (currentStep) {
      case 1:
        if (!formData.companyInfo.companyName) {
          toast.error('Nama perusahaan harus diisi');
          return false;
        }
        if (!formData.companyInfo.province) {
          toast.error('Provinsi harus dipilih');
          return false;
        }
        return true;
      case 2:
        const hasValidDirector = formData.directors.some(
          (d) => d.name && d.ktp
        );
        if (!hasValidDirector) {
          toast.error('Minimal 1 direktur dengan nama dan KTP harus diisi');
          return false;
        }
        return true;
      case 3:
        const hasValidCommissioner = formData.commissioners.some(
          (c) => c.name && c.ktp
        );
        if (!hasValidCommissioner) {
          toast.error('Minimal 1 komisaris dengan nama dan KTP harus diisi');
          return false;
        }
        return true;
      case 4:
        if (!formData.kbliBank.kbli) {
          toast.error('KBLI harus dipilih');
          return false;
        }
        if (!formData.kbliBank.bank) {
          toast.error('Bank rekanan harus dipilih');
          return false;
        }
        return true;
      case 5:
        if (!formData.payment.paymentProof) {
          toast.error('Bukti pembayaran harus diupload');
          return false;
        }
        return true;
      default:
        return true;
    }
  };

  const handleSubmit = () => {
    toast.success('Permohonan CV berhasil diajukan!', {
      description: 'Tim kami akan menghubungi Anda dalam 1-2 hari kerja.',
    });
    localStorage.removeItem(STORAGE_KEY);
    // Reset form if needed
  };

  const renderStepContent = () => {
    switch (currentStep) {
      case 1:
        return (
          <CompanyInfoStep
            data={formData.companyInfo}
            onChange={(data) => updateFormData('companyInfo', data)}
          />
        );
      case 2:
        return (
          <DirectorStep
            directors={formData.directors}
            onChange={(data) => updateFormData('directors', data)}
          />
        );
      case 3:
        return (
          <CommissionerStep
            commissioners={formData.commissioners}
            onChange={(data) => updateFormData('commissioners', data)}
          />
        );
      case 4:
        return (
          <KBLIBankStep
            data={formData.kbliBank}
            onChange={(data) => updateFormData('kbliBank', data)}
          />
        );
      case 5:
        return (
          <PaymentStep
            data={formData.payment}
            onChange={(data) => updateFormData('payment', data)}
            formData={formData}
          />
        );
      default:
        return null;
    }
  };

  return (
    <div className="min-h-screen bg-muted/30">
      {/* Header */}
      <header className="bg-primary text-primary-foreground py-4 px-4 shadow-md sticky top-0 z-50">
        <div className="max-w-2xl mx-auto">
          <div className="flex items-center justify-between">
            <div className="flex items-center gap-2">
              <Building2 className="w-6 h-6" />
              <h1 className="text-lg font-semibold">Permohonan CV</h1>
            </div>
            {lastSaved && (
              <div className="flex items-center gap-1.5 text-xs text-primary-foreground/80">
                <Save className="w-3.5 h-3.5 animate-pulse-subtle" />
                <span>Tersimpan otomatis</span>
              </div>
            )}
          </div>
        </div>
      </header>

      {/* Progress Stepper */}
      <div className="bg-card border-b border-border sticky top-[56px] z-40">
        <div className="max-w-2xl mx-auto px-4 py-4">
          <ProgressStepper steps={STEPS} currentStep={currentStep} />
        </div>
      </div>

      {/* Main Content */}
      <main className="max-w-2xl mx-auto px-4 py-6 pb-28">
        <Card className="card-elevated animate-slide-in">
          <CardContent className="p-6">
            {/* Step Title */}
            <div className="mb-6">
              <div className="flex items-center gap-3 mb-2">
                {React.createElement(STEPS[currentStep - 1].icon, {
                  className: 'w-6 h-6 text-primary',
                })}
                <h2 className="text-xl font-semibold text-foreground">
                  {STEPS[currentStep - 1].title}
                </h2>
              </div>
              <p className="text-sm text-muted-foreground ml-9">
                Langkah {currentStep} dari {STEPS.length}
              </p>
            </div>

            {/* Step Content */}
            <div className="form-section">{renderStepContent()}</div>
          </CardContent>
        </Card>
      </main>

      {/* Sticky Bottom Navigation */}
      <div className="fixed bottom-0 left-0 right-0 bg-card border-t border-border shadow-lg z-50">
        <div className="max-w-2xl mx-auto px-4 py-4">
          <div className="flex gap-3">
            {currentStep > 1 && (
              <Button
                variant="outline"
                onClick={handleBack}
                className="flex-shrink-0 btn-touch"
              >
                <ChevronLeft className="w-4 h-4 mr-1" />
                Kembali
              </Button>
            )}
            <Button
              onClick={handleNext}
              className="flex-1 btn-touch bg-accent hover:bg-accent/90 text-accent-foreground font-medium"
            >
              {currentStep === STEPS.length ? (
                <>
                  <CheckCircle2 className="w-4 h-4 mr-2" />
                  Kirim Permohonan
                </>
              ) : (
                'Lanjut'
              )}
            </Button>
          </div>
          <p className="text-xs text-center text-muted-foreground mt-2">
            Estimasi waktu: ~{6 - currentStep} menit lagi
          </p>
        </div>
      </div>
    </div>
  );
}