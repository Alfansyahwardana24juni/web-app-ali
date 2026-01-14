import React from 'react';
import { Check } from 'lucide-react';
import { cn } from '../lib/utils';

export default function ProgressStepper({ steps, currentStep }) {
  return (
    <div className="w-full">
      {/* Mobile: Compact Progress Bar */}
      <div className="md:hidden">
        <div className="flex items-center justify-between mb-2">
          <span className="text-sm font-medium text-foreground">
            {steps[currentStep - 1].shortTitle}
          </span>
          <span className="text-sm text-muted-foreground">
            {currentStep}/{steps.length}
          </span>
        </div>
        <div className="h-2 bg-muted rounded-full overflow-hidden">
          <div
            className="h-full bg-accent transition-all duration-500 ease-out animate-progress"
            style={{ width: `${(currentStep / steps.length) * 100}%` }}
          />
        </div>
      </div>

      {/* Desktop: Full Stepper */}
      <div className="hidden md:block">
        <div className="flex items-center justify-between relative">
          {/* Connection Line */}
          <div className="absolute left-0 right-0 top-5 h-0.5 bg-muted z-0">
            <div
              className="h-full bg-accent transition-all duration-500 ease-out"
              style={{
                width: `${((currentStep - 1) / (steps.length - 1)) * 100}%`,
              }}
            />
          </div>

          {/* Steps */}
          {steps.map((step, index) => {
            const stepNumber = index + 1;
            const isCompleted = currentStep > stepNumber;
            const isCurrent = currentStep === stepNumber;
            const isPending = currentStep < stepNumber;

            return (
              <div
                key={step.id}
                className="flex flex-col items-center relative z-10"
              >
                {/* Circle */}
                <div
                  className={cn(
                    'w-10 h-10 rounded-full flex items-center justify-center transition-all duration-300 mb-2',
                    isCompleted &&
                      'bg-accent text-accent-foreground shadow-md',
                    isCurrent &&
                      'bg-primary text-primary-foreground shadow-lg scale-110',
                    isPending && 'bg-muted text-muted-foreground'
                  )}
                >
                  {isCompleted ? (
                    <Check className="w-5 h-5" />
                  ) : (
                    <step.icon className="w-5 h-5" />
                  )}
                </div>
                {/* Label */}
                <span
                  className={cn(
                    'text-xs font-medium text-center transition-colors',
                    (isCompleted || isCurrent)
                      ? 'text-foreground'
                      : 'text-muted-foreground'
                  )}
                >
                  {step.shortTitle}
                </span>
              </div>
            );
          })}
        </div>
      </div>
    </div>
  );
}