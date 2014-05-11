num=1;
 for ii = [1989 1991 1996 1998 1999 2004],
A = xlsread(['C:\Users\Divya\Dropbox\forSrikanth_hackathon\2004\BNorth_' num2str(ii) '.xlsx']);
V = A(:,2);
C = A(:,4);
indep(num) = sum(V(C==3));
cong(num) = sum(V(C==0));
bjp(num) = sum(V(C==1));
num = num + 1;
end;

indep_bar = sum(indep(:))/6;
bjp_bar = sum(bjp(:))/6;
cong_bar = sum(cong(:))/6;

s_indep = sqrt(sum((indep - indep_bar).^2));
s_bjp = sqrt(sum((bjp - bjp_bar).^2));
s_cong = sqrt(sum((cong - cong_bar).^2));

corr_coeff_ic = sum((indep-indep_bar).*(cong-cong_bar))./(s_indep*s_cong);
corr_coeff_ib = sum((indep-indep_bar).*(cong-bjp_bar))./(s_indep*s_bjp);
corr_coeff_cb = sum((cong-cong_bar).*(bjp-bjp_bar))./(s_cong*s_bjp);

