import type { Config } from 'tailwindcss'

export default <Partial<Config>>{
  theme: {
    extend: {
      colors: {
        brand: 'hsl(160, 60%, 38%)',
        'brand-light': 'hsl(160, 50%, 94%)',
        'brand-dark': 'hsl(160, 60%, 28%)',
        surface: 'hsl(220, 20%, 97%)',
        'surface-card': 'hsl(0, 0%, 100%)',
        txt: 'hsl(220, 25%, 12%)',
        'txt-muted': 'hsl(220, 10%, 46%)',
        'border-soft': 'hsl(220, 13%, 88%)',
      },
    },
  },
}
