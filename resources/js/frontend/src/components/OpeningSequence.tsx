import React, { useState, useEffect } from 'react';
import { Film } from 'lucide-react';

interface OpeningSequenceProps {
  onComplete: () => void;
}

const OpeningSequence: React.FC<OpeningSequenceProps> = ({ onComplete }) => {
  const [currentPhase, setCurrentPhase] = useState<'logo' | 'production' | 'presenting' | 'complete'>('logo');
  const [isSkipped, setIsSkipped] = useState(false);

  useEffect(() => {
    // Check if user has seen the intro before (in this session)
    const hasSeenIntro = sessionStorage.getItem('hasSeenIntro');
    if (hasSeenIntro) {
      onComplete();
      return;
    }

    const timeouts: NodeJS.Timeout[] = [];

    // Logo phase (0-800ms)
    timeouts.push(setTimeout(() => {
      if (!isSkipped) setCurrentPhase('production');
    }, 800));

    // Production text phase (800-1600ms)
    timeouts.push(setTimeout(() => {
      if (!isSkipped) setCurrentPhase('presenting');
    }, 1600));

    // Presenting phase (1600-2200ms)
    timeouts.push(setTimeout(() => {
      if (!isSkipped) {
        setCurrentPhase('complete');
        sessionStorage.setItem('hasSeenIntro', 'true');
        onComplete();
      }
    }, 2200));

    return () => {
      timeouts.forEach(timeout => clearTimeout(timeout));
    };
  }, [onComplete, isSkipped]);

  const handleSkip = () => {
    setIsSkipped(true);
    sessionStorage.setItem('hasSeenIntro', 'true');
    onComplete();
  };

  if (currentPhase === 'complete') return null;

  return (
    <div className="fixed inset-0 z-[9999] bg-black flex items-center justify-center">
      {/* Skip button */}
      <button
        onClick={handleSkip}
        className="absolute top-8 right-8 text-gray-400 hover:text-white transition-colors duration-300 text-sm tracking-wide z-10"
      >
        SKIP
      </button>

      {/* Logo Phase */}
      {currentPhase === 'logo' && (
        <div className="text-center animate-fade-in-up">
          <div className="flex items-center justify-center space-x-4 mb-8">
            <Film className="h-16 w-16 text-white animate-pulse" />
            <div className="text-4xl md:text-5xl font-bold tracking-tight text-white cinematic-title">
              SINEMAKU PICTURES
            </div>
          </div>
          <div className="w-32 h-px bg-white/30 mx-auto animate-scale-in animate-delay-500" />
        </div>
      )}

      {/* Production Text Phase */}
      {currentPhase === 'production' && (
        <div className="text-center animate-fade-in-up">
          <div className="text-xl md:text-2xl text-gray-300 editorial-text tracking-widest mb-8 animate-text-reveal">
            A SINEMAKU PICTURES PRODUCTION
          </div>
          <div className="flex items-center justify-center space-x-2">
            <div className="w-2 h-2 bg-white rounded-full animate-pulse" />
            <div className="w-2 h-2 bg-white rounded-full animate-pulse animate-delay-200" />
            <div className="w-2 h-2 bg-white rounded-full animate-pulse animate-delay-400" />
          </div>
        </div>
      )}

      {/* Presenting Phase */}
      {currentPhase === 'presenting' && (
        <div className="text-center animate-fade-in-up">
          <div className="text-3xl md:text-4xl text-white cinematic-title tracking-wide animate-text-reveal">
            Presenting...
          </div>
          <div className="mt-8 w-48 h-px bg-gradient-to-r from-transparent via-white to-transparent animate-scale-in" />
        </div>
      )}

      {/* Subtle film grain overlay */}
      <div className="absolute inset-0 opacity-5 pointer-events-none">
        <div className="w-full h-full bg-gradient-to-br from-gray-800 via-transparent to-gray-900 animate-pulse" />
      </div>
    </div>
  );
};

export default OpeningSequence;