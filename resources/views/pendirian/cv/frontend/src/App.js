import React from 'react';
import FormWizard from './components/FormWizard';
import { Toaster } from './components/ui/sonner';

export default function App() {
  return (
    <div className="min-h-screen bg-background">
      <FormWizard />
      <Toaster position="top-center" />
    </div>
  );
}